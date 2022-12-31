import $ from 'jquery';
import { error, ajaxError } from '../app/message';
import { animateEl } from '../app/animate';
import {
  getFormValues,
  disableForm,
  enableForm,
  removeButtonLoading
} from '../form/form';
import { inputError } from './inputs/inputs';
import { app } from '../app/app';

/**
 * Domready
 */

$(function () {
  // Add send form request event
  $('form[data-form][data-request-url]').on('submit', function (ev) {
    ev.preventDefault();
    sendForm($(this));
    return false;
  });
});

/**
 * Send request
 */

function sendForm(formEl) {
  // Form data
  formEl = $(formEl);
  const formName = $(formEl).attr('data-form');
  const formSelector = 'form[data-form="' + formName + '"]';
  const formButtonSelector = '[data-form-submit-button]';

  // Abort if request is already in progress
  if (app.isFormSending) {
    return false;
  }

  // Abort if there are still errors
  if (formEl.find('[data-form-value][data-error]').length) {
    animateEl($(formButtonSelector), 'shake');
    return false;
  }

  // Options
  const formUrl = formEl.attr('data-request-url');
  const keepDisabled = formEl.is('[data-keep-disabled-on-success]');

  // Send request
  $.ajax({
    url: formUrl,
    method: 'post',
    data: getFormValues(formSelector),
    headers: {
      'X-CSRF-TOKEN': $('#csrf-token').val()
    },
    beforeSend: function () {
      app.isFormSending = true;
      disableForm(formSelector, formButtonSelector);
    },
    success: function (response) {
      app.isFormSending = false;

      if (!keepDisabled) {
        enableForm(formSelector, formButtonSelector);
      } else {
        removeButtonLoading(formButtonSelector);
      }

      // Success
      if (response && response.success) {
        // Success callback
        if (formEl.data('successCallback')) {
          formEl.data('successCallback')(response);
        }
        return;
      }

      // Error
      enableForm(formSelector, formButtonSelector);
      animateEl($(formButtonSelector), 'shake');
      error();
    },
    error: function (xhr) {
      enableForm(formSelector, formButtonSelector);
      animateEl($(formButtonSelector), 'shake');
      app.isFormSending = false;

      // Form errors
      try {
        const response = JSON.parse(xhr.responseText);

        if (response && response.errors) {
          // Show errors
          $.each(response.errors, function (inputName, error) {
            inputError(
              formEl.find('[data-form-value-name="' + inputName + '"]'),
              error
            );
          });

          // Validation error message
          error(i18n['form.default-validation-error']);

          // Error callback
          if (formEl.data('errorCallback')) {
            formEl.data('errorCallback')(response);
          }
          return;
        }
      } catch (e) {}

      ajaxError();
    }
  });
}
