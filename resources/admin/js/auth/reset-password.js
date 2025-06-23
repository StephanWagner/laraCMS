import { apiFetch } from '../utils/api-fetch';
import { animate } from '../utils/animate';
import { showAuthFormError, showAuthFormSuccess } from './form';

function initResetPassword() {
  const submitButton = document.querySelector('[data-reset-password-form-submit-button]');

  if (!submitButton) {
    return;
  }

  submitButton.addEventListener('click', () => {
    const csrfInput = document.querySelector('[data-reset-password-form-input="csrf"]');
    const emailInput = document.querySelector('[data-reset-password-form-input="email"]');

    const csrf = csrfInput?.value;
    const email = emailInput?.value.trim();

    if (!email) {
      !email && emailInput.classList.add('-error');
      animate(submitButton, 'shake');
      return;
    }

    submitButton.classList.add('-loading');
    submitButton.disabled = true;
    emailInput.disabled = true;

    apiFetch('/admin/reset-password', {
      method: 'POST',
      data: { csrf, email },
      onSuccess: (response) => {
        if (response.success) {
          showAuthFormSuccess(submitButton, response.message);
        } else {
          showAuthFormError(submitButton, response.message);
          submitButton.disabled = false;
          emailInput.disabled = false;
        }
      },
      onError: (response) => {
        showAuthFormError(submitButton, response.message);
        submitButton.disabled = false;
        emailInput.disabled = false;
      }
    }).finally(() => {
      submitButton.classList.remove('-loading');
    });
  });
}

export { initResetPassword }
