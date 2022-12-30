import $ from 'jquery';
import './input-select';
import './input-textfield';
import { valueGetters } from './values/values';

/**
 * Get form values
 */

function getFormValues(formSelector) {
  const valueContainers = $(formSelector).find('[data-form-value]');

  let values = [];

  $.each(valueContainers, function (index, item) {
    const itemEl = $(item);
    const name = itemEl.attr('data-form-value-name');
    const type = itemEl.attr('data-form-value-type');
    values.push({
      name: name,
      value: valueGetters[type](itemEl)
    });
  });

  return values;
}

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

/**
 * Add or remove loading bars from button
 */

function addButtonLoading(buttonSelector) {
  $(buttonSelector).addClass('loading-bar');
}

function removeButtonLoading(buttonSelector) {
  $(buttonSelector).removeClass('loading-bar');
}

/**
 * Export
 */

export {
  getFormValues,
  disableForm,
  enableForm,
  removeButtonLoading,
  addButtonLoading
};
