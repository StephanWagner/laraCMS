import { apiFetch } from '../services/api-fetch';
import { animate } from '../utils/animate';
import { showAuthFormError } from './form';

function initLogin() {
  const submitButton = document.querySelector('[data-login-form-submit-button]');

  if (!submitButton) {
    return;
  }

  submitButton.addEventListener('click', () => {
    const csrfInput = document.querySelector('[data-login-form-input="csrf"]');
    const emailInput = document.querySelector('[data-login-form-input="email"]');
    const passwordInput = document.querySelector('[data-login-form-input="password"]');

    const csrf = csrfInput?.value;
    const email = emailInput?.value.trim();
    const password = passwordInput?.value;

    if (!email || !password) {
      !email && emailInput.classList.add('-error');
      !password && passwordInput.classList.add('-error');
      animate(submitButton, 'shake');
      return;
    }

    submitButton.classList.add('-loading');
    submitButton.disabled = true;

    apiFetch({
      url: '/admin/login',
      method: 'POST',
      data: { csrf, email, password },
      success: response => {
        if (response.success) {
          window.location.href = response.redirect || '/admin';
        } else {
          showAuthFormError(submitButton, response.message);
        }
      },
      error: response => {
        showAuthFormError(submitButton, response.message);
      },
      complete: () => {
        submitButton.classList.remove('-loading');
        submitButton.disabled = false;
      },
    });
  });
}

export { initLogin };
