import $ from 'jquery';
import { initSelectFields } from './input-select.js';
import { initPasswordFields, initTextfieldSubmit } from './input-textfield.js';

/**
 * Init form inputs
 */

function initFormInputs() {
  initSelectFields();
  initTextfieldSubmit();
  initPasswordFields();
  initErrorEvents();
}

/**
 * Add input errors
 */

function inputError(el, msg) {
  el = $(el);
  el.attr('data-error', '');
  el.find('.input__error').remove();
  el.append($('<div class="input__error"/>').html(msg));
}

/**
 * Init error events
 */

function initErrorEvents() {
  const errorElements = [
    '.input__wrapper:not([data-error-events-added]) [data-error-trigger]'
  ];

  $(errorElements.join(',')).on('change input', function () {
    var wrapper = $(this).parents('.input__wrapper').first();
    wrapper.removeAttr('data-error');
    wrapper.find('.input__error').remove();
    wrapper.attr('data-error-events-added', '');
  });
}

/**
 * Domready
 */

$(function () {
  // Init password fields
  initErrorEvents();
});

/**
 * Export
 */

export { initFormInputs, inputError };
