import { __ } from "../utils/locale";
import { animate } from "../utils/animate";

function showAuthFormError(submitButton, txt) {
  const formMessageEl = document.querySelector('.auth__form-message');
  formMessageEl.innerHTML = txt || __('error');
  formMessageEl.classList.remove('-success');
  formMessageEl.classList.add('-error');
  animate(submitButton, 'shake');
}

export { showAuthFormError }
