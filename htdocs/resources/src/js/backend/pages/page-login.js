import $ from 'jquery';
import { animateEl } from '../app/animate';
import { error } from '../app/message';

/**
 * Domready
 */

$(function () {
  // Success callback
  const formEl = $('[data-form="login"]');
  formEl.data('successCallback', function () {
    window.location.href = '/admin';
  });

  // Error callback
  formEl.data('errorCallback', function (response) {
    if (response.error) {
      var errorEl = $('.logged-out__error');
      errorEl.html(response.error);
      errorEl.addClass('-active');
      animateEl($('.logged-out__error'), 'pulseUpMedium');
    } else {
      error();
    }
  });
});
