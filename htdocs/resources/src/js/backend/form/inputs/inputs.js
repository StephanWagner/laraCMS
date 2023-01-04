import $ from 'jquery';
import jBox from 'jbox';
import { initSelectFields } from './input-select';
import { initPasswordFields, initTextfieldSubmit } from './input-textfield';
import { app } from '../../app/app';

/**
 * Init form inputs
 */

function initFormInputs() {
  initSelectFields();
  initTextfieldSubmit();
  initPasswordFields();
  initErrorEvents();
  initInputDescription();
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
 * Init input description
 */

function initInputDescription() {
  if (!app.tooltipInputDescription) {
    app.tooltipInputDescription = new jBox('Tooltip', {
      theme: 'TooltipBorder',
      addClass: 'tooltip__small tooltip__input-description',
      attach: '[data-input-description-trigger]',
      adjustTracker: true,
      maxWidth: 380 + 8 + 8 - 2 -2,
      position: {
        x: 'center',
        y: 'bottom'
      },
      offset: {
        x: (24 - 18) / 2 - 2,
        y: -2
      },
      pointer: 'right:12',
      animation: 'move',
      zIndex: 9000,
      createOnInit: false,
      trigger: 'click',
      closeOnClick: 'body',
      closeOnEsc: true,
      onOpen: function () {
        $('[data-input-description-trigger]').removeClass('-active');
        this.source.addClass('-active');
        const inputName = this.source.attr('data-input-description-trigger');
        const content = $(
          '[data-input-description-content="' + inputName + '"]'
        ).html();
        this.setContent(content);
      },
      onClose: function () {
        $('[data-input-description-trigger]').removeClass('-active');
      }
    });
  } else {
    app.tooltipInputDescription.attach();
  }
}

/**
 * Domready
 */

$(function () {
  // Init password fields
  initErrorEvents();

  // Init input description
  initInputDescription();
});

/**
 * Export
 */

export { initFormInputs, inputError };
