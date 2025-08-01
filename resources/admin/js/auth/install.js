import { apiFetch } from '../services/api-fetch';
import { animate } from '../utils/animate';
import { showAuthFormError } from './form';

function initInstall() {
  const submitButton = document.querySelector('[data-install-form-submit-button]');

  if (!submitButton) {
    return;
  }

  submitButton.addEventListener('click', () => {
    const csrfInput = document.querySelector('[data-install-form-input="csrf"]');
    const nameInput = document.querySelector('[data-install-form-input="name"]');
    const emailInput = document.querySelector('[data-install-form-input="email"]');
    const passwordInput = document.querySelector('[data-install-form-input="password"]');

    const csrf = csrfInput?.value;
    const name = nameInput?.value.trim();
    const email = emailInput?.value.trim();
    const password = passwordInput?.value;

    if (!name || !email || !password) {
      !name && nameInput.classList.add('-error');
      !email && emailInput.classList.add('-error');
      !password && passwordInput.classList.add('-error');
      animate(submitButton, 'shake');
      return;
    }

    submitButton.classList.add('-loading');
    submitButton.disabled = true;

    apiFetch({
      url: '/admin/install',
      method: 'POST',
      data: { csrf, name, email, password },
      success: response => {
        if (response.success) {
          window.location.href = response.redirect || '/admin/login';
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

export { initInstall };
