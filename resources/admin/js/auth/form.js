import { __ } from "../utils/locale";
import { animate } from "../utils/animate";

function showAuthFormMessage(type = 'error', submitButton, txt) {
  const formMessageEl = document.querySelector('.auth__form-message');
  formMessageEl.innerHTML = txt || __('error');
  formMessageEl.classList[type === 'success' ? 'add' : 'remove']('-success');
  formMessageEl.classList[type === 'error' ? 'add' : 'remove']('-error');
  formMessageEl.classList.add('-active');
  (type === 'error') && animate(submitButton, 'shake');
}

function showAuthFormError(submitButton, txt) {
  showAuthFormMessage('error', submitButton, txt);
}

function showAuthFormSuccess(submitButton, txt) {
  showAuthFormMessage('success', submitButton, txt);
}

export { showAuthFormError, showAuthFormSuccess }
