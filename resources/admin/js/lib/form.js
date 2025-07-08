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

  elements.forEach((input) => {
    if (input.dataset._submitOnEnterListenerAttached) return;
    input.dataset._submitOnEnterListenerAttached = 'true';

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
export function initClearErrorOnInput(scope = document) {
  const elements = [];

  // Include the scope itself if it matches
  if (scope.matches?.('[data-clear-error-on-input]')) {
    elements.push(scope);
  }

  // Include all matching children
  elements.push(...scope.querySelectorAll('[data-clear-error-on-input]'));

  elements.forEach((el) => {
    if (el.dataset._clearErrorOnInputListenerAttached) return;
    el.dataset._clearErrorOnInputListenerAttached = 'true';

    const clearError = () => {
      el.classList.remove('-error');
    };

    el.addEventListener('input', clearError);
    el.addEventListener('change', clearError);
    el.addEventListener('paste', clearError);
  });
}

export function initForms() {
  initClearErrorOnInput();
  initSubmitOnEnter();
}
