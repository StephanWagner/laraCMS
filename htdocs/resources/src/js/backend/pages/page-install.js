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
  // Change language
  $('.logged-out__form [data-select-language]').on('change', function () {
    const languageId = $(this).val();
    window.location.href = '/admin/install?lang=' + languageId;
  });

  // Add send form request event
  $('.install_submit-button').on('click', function (ev) {
    ev.preventDefault();
    sendInstallForm();
    return false;
  });
});

/**
 * Send install request
 */

const formSelector = 'form[data-install-form]';
const formButtonSelector = 'button[data-install-form-button]';
let isInstallFormSending = false;

function sendInstallForm() {
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
      isInstallFormSending = true;
      disableForm(formSelector, formButtonSelector);
    },
    success: function (response) {
      isInstallFormSending = false;
      removeButtonLoading(formButtonSelector);

      // Success
      if (response && response.success) {

        // TODO Go to login page

        //     if (!response.success) {
        //       error();
        //       return;
        //     }
        //     $.each(response.chats, function (index, item) {
        //       var messageHTML = getChatMessageHTML(item);
        //       messageHTML.appendTo($('.chat__messages'));
        //     });
        //     if (!response.hasMore) {
        //       $('[data-chat-load-more]').remove();
        //       $('<div class="chat__message-all-loaded"/>')
        //         .html('Alle Nachrichten geladen')
        //         .appendTo($('.chat__wrapper'));
        //     }

        return;
      }

      // Errors
      if (response && response.success) {

        // Show errors
      }
      enableForm(formSelector, formButtonSelector);
      animateEl($(formButtonSelector), 'shake');
      error();
    },
    error: function () {
      enableForm(formSelector, formButtonSelector);
      animateEl($(formButtonSelector), 'shake');
      isInstallFormSending = false;
      ajaxError();
    }
  });
}
