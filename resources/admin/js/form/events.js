/**
 * Init the submit form on enter events
 */
export function initSubmitOnEnter(scope = document) {
  const elements = [];

  // Include scope itself if it matches the selector
  if (scope.matches?.('[data-submit-on-enter]')) {
    elements.push(scope);
  }

  // Also include all matching descendants
  elements.push(...scope.querySelectorAll('[data-submit-on-enter]'));

  elements.forEach(inputEl => {
    inputEl.addEventListener('keydown', ev => {
      if (ev.key === 'Enter') {
        ev.preventDefault();

        let submitButton;

        const attr = inputEl.getAttribute('data-submit-on-enter');

        if (attr) {
          submitButton = document.querySelector('[data-submit-button="' + attr + '"]');
        } else {
          const form = inputEl.closest('form');

          if (form) {
            submitButton = form.querySelector('[data-submit-button]');
          }
        }
        if (submitButton) {
          submitButton.click();
        }
      }
      inputEl.removeAttribute('data-submit-on-enter');
    });
  });
}

/**
 * Clear input errors on input
 */
export function initClearErrorOnInput(scope = document) {
  const elements = [];

  // Include the scope itself if it matches
  if (scope.matches?.('[data-clear-error-on-input]')) {
    elements.push(scope);
  }

  // Include all matching children
  elements.push(...scope.querySelectorAll('[data-clear-error-on-input]'));

  elements.forEach(inputEl => {
    const clearError = () => {
      inputEl.classList.remove('-error');
    };

    inputEl.addEventListener('input', clearError);
    inputEl.addEventListener('change', clearError);
    inputEl.addEventListener('paste', clearError);
    inputEl.removeAttribute('data-clear-error-on-input');
  });
}

export function initFormEvents() {
  initClearErrorOnInput();
  initSubmitOnEnter();
}
