import $ from 'jquery';
import { ajaxError } from '../app/message';

/**
 * Domready
 */

$(function () {
  $('.logged-out__form [data-select-language]').on('change', function () {
    const languageId = $(this).val();
    window.location.href = '/admin/install?lang=' + languageId;
  });
});


// Send install request

// var app = {};

// $.ajax({
//     url: '/admin/chat/load',
//     method: 'post',
//     data: {
//       // lastId: lastId
//     },
//     headers: {
//       'X-CSRF-TOKEN': $('#csrf-token').val()
//     },
//     beforeSend: function () {
//       app.loadingMoreChatMessages = true;
//       $('[data-chat-load-more]').attr('disabled', 'disabled');
//     },
//     success: function (response) {
//       app.loadingMoreChatMessages = false;
//       $('[data-chat-load-more]').removeAttr('disabled');
//       if (response && response.success) {
//         if (!response.success) {
//           error();
//           return;
//         }

//         $.each(response.chats, function (index, item) {
//           var messageHTML = getChatMessageHTML(item);
//           messageHTML.appendTo($('.chat__messages'));
//         });

//         if (!response.hasMore) {
//           $('[data-chat-load-more]').remove();
//           $('<div class="chat__message-all-loaded"/>')
//             .html('Alle Nachrichten geladen')
//             .appendTo($('.chat__wrapper'));
//         }
//         return;
//       }
//       animateEl($('[data-chat-load-more]'), 'shake');
//       error();
//     },
//     error: function () {
//       $('[data-chat-load-more]').removeAttr('disabled');
//       animateEl($('[data-chat-load-more]'), 'shake');
//       app.loadingMoreChatMessages = false;
//       ajaxError();
//     }
//   });
