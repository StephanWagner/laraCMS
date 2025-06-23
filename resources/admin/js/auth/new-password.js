import { apiFetch } from '../utils/api-fetch';
import { animate } from '../utils/animate';
import { showAuthFormError, showAuthFormSuccess } from './form';

function initNewPassword() {
  const submitButton = document.querySelector('[data-new-password-form-submit-button]');

  if (!submitButton) {
    return;
  }

  submitButton.addEventListener('click', () => {
    const csrfInput = document.querySelector('[data-new-password-form-input="csrf"]');
    const userIdInput = document.querySelector('[data-new-password-form-input="user-id"]');
    const resetPasswordHashInput = document.querySelector('[data-new-password-form-input="reset-password-hash"]');
    const passwordInput = document.querySelector('[data-new-password-form-input="password"]');
    const passwordRepeatInput = document.querySelector('[data-new-password-form-input="password-repeat"]');

    const csrf = csrfInput?.value;
    const userId = userIdInput?.value;
    const resetPasswordHash = resetPasswordHashInput?.value;
    const password = passwordInput?.value;
    const passwordRepeat = passwordRepeatInput?.value;

    if (!password || !passwordRepeat || !userId || !resetPasswordHash) {
      !password && passwordInput.classList.add('-error');
      !passwordRepeat && passwordRepeatInput.classList.add('-error');
      animate(submitButton, 'shake');
      return;
    }

    submitButton.classList.add('-loading');
    submitButton.disabled = true;
    passwordInput.disabled = true;
    passwordRepeatInput.disabled = true;

    apiFetch('/admin/new-password', {
      method: 'POST',
      data: { csrf, userId, resetPasswordHash, password, passwordRepeat },
      onSuccess: (response) => {
        if (response.success) {
          showAuthFormSuccess(submitButton, response.message);
        } else {
          showAuthFormError(submitButton, response.message);
          submitButton.disabled = false;
          passwordInput.disabled = false;
          passwordRepeatInput.disabled = false;
        }
      },
      onError: (response) => {
        showAuthFormError(submitButton, response.message);
        submitButton.disabled = false;
        passwordInput.disabled = false;
        passwordRepeatInput.disabled = false;
      }
    }).finally(() => {
      submitButton.classList.remove('-loading');
    });
  });
}

export { initNewPassword }
