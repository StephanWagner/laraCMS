/**
 *
 */

function initFormSubmitOnEnter() {
  document.querySelectorAll('[data-submit-on-enter]').forEach((input) => {
    input.addEventListener('keydown', (ev) => {
      if (ev.key === 'Enter') {
        ev.preventDefault();

        const form = input.closest('form');
        if (!form) return;

        const submitButton = form.querySelector('[data-submit-button]');
        if (submitButton) {
          submitButton.click();
        }
      }
    });
  });
}

/**
 * Clear input errors on input
 */
function initClearErrorOnInput() {
  const elements = document.querySelectorAll('[data-clear-error-on-input]');

  elements.forEach((el) => {
    const clearError = () => {
      el.classList.remove('-error');
    };

    el.addEventListener('input', clearError);
    el.addEventListener('change', clearError);
    el.addEventListener('paste', clearError);
  });
}

function initForms() {
  initClearErrorOnInput();
  initFormSubmitOnEnter();
}

export { initForms }
