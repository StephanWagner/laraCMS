import $ from 'jquery';

// Init password fields

function initPasswordFields() {
  $('[data-show-password-trigger]:not(.-init)').each(function (index, item) {
    if (!$(item).data('show-password-initialized')) {
      $(item).on('click', function (ev) {
        const wrapper = $(item).parents('[data-show-password-container]');
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
    }
  });
}

// Domready

$(function () {
  // Init password fields
  initPasswordFields();
});
