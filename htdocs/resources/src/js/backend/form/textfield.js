import $ from 'jquery';

/**
 * Init password fields
 */

function initPasswordFields() {
  $('[data-show-password-trigger]:not(.-init)').each(function (index, item) {
    $(item).on('click', function (ev) {
      const wrapper = $(item).parents('[data-show-password-container]');
      if (wrapper.hasClass('-disabled')) {
        return false;
      }
      if (wrapper.length) {
        const input = wrapper.find('[data-show-password-input]');
        if (input.length) {
          wrapper.toggleClass('-show-password');
          const passwordIsShown = wrapper.hasClass('-show-password');
          input.attr('type', passwordIsShown ? 'text' : 'password');
          input.trigger('focus');
        }
      }
    });
    $(item).addClass('-init');
  });
}

/**
 * Init textfield form submit
 */

function initTextfieldSubmit() {
  $('[data-submit-on-enter]').on('keypress', function (ev) {
    if (ev.key == 'Enter') {
      ev.preventDefault();

      var targetButton = $($(this).attr('data-submit-on-enter'));
      if (!targetButton.length) {
        targetButton = $(this).parents('form').find('button[type="submit"]');
      }

      $(targetButton).trigger('click');
    }
  });
}

/**
 * Domready
 */

$(function () {
  // Init password fields
  initPasswordFields();

  // Init textfield form submit
  initTextfieldSubmit();
});
