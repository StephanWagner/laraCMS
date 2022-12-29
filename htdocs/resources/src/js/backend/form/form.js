import $ from 'jquery';
import './select';
import './textfield';

/**
 * Disable or enable forms
 */

function disableForm(selector, buttonSelector) {
  $(selector)
    .find('input, textarea, select, button')
    .attr('disabled', 'disabled');

  $(selector).find('.input__container').addClass('-disabled');

  if (buttonSelector) {
    getFormButton(selector, buttonSelector).addClass('loading-bar');
  }
}

function enableForm(selector, buttonSelector) {
  $(selector)
    .find('input, textarea, select, button')
    .removeAttr('disabled', 'disabled');

  $(selector).find('.input__container').removeClass('-disabled');

  if (buttonSelector) {
    getFormButton(selector, buttonSelector).removeClass('loading-bar');
  }
}

function getFormButton(selector, buttonSelector) {
  return buttonSelector === true
    ? $(selector).find('button[type="submit"]')
    : $(buttonSelector);
}

export { disableForm, enableForm };
