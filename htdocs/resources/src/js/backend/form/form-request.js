import $ from 'jquery';
import { error, ajaxError } from '../app/message';
import { animateEl } from '../app/animate';
import {
  getFormValues,
  disableForm,
  enableForm,
  removeButtonLoading
} from '../form/form';

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
  const formName = $(formEl).attr('data-form');
  const formSelector = 'form[data-form="' + formName + '"]';
  const formButtonSelector = '[data-form-submit-button]';
  let isFormSending = false;

  const keepDisabledOnSuccess = $(formSelector)[0].hasAttribute('data-keep-disabled-on-success');

  $.ajax({
    url: '/admin/installRequest',
    method: 'post',
    data: {
      values: getFormValues(formSelector)
    },
    headers: {
      'X-CSRF-TOKEN': $('#csrf-token').val()
    },
    beforeSend: function () {
      isFormSending = true;
      disableForm(formSelector, formButtonSelector);
    },
    success: function (response) {
      isFormSending = false;

      if (!keepDisabledOnSuccess) {
        enableForm(formSelector, formButtonSelector);
      } else {
        removeButtonLoading(formButtonSelector);
      }

      // Success
      if (response && response.success) {
        // TODO Callback

        return;
      }

      // Errors
      if (response && response.errors) {
        // Show errors
      }

      enableForm(formSelector, formButtonSelector);
      animateEl($(formButtonSelector), 'shake');
      error();
    },
    error: function () {
      enableForm(formSelector, formButtonSelector);
      animateEl($(formButtonSelector), 'shake');
      isFormSending = false;
      ajaxError();
    }
  });
}
