import { config } from '../config/config';
import { __ } from '../utils/locale';

/**
 * Show flash message
 */
export function showFlashMessage(title, text = null, type = 'success', prependTo = '.form__wrapper') {
  const formWrapperEl = document.querySelector(prependTo);
  if (!formWrapperEl) return;

  const oldWrapperEl = formWrapperEl.querySelector('.flash-message__wrapper');
  if (oldWrapperEl) oldWrapperEl.remove();

  const wrapperEl = document.createElement('div');
  wrapperEl.className = 'flash-message__wrapper -' + type;

  const titleEl = document.createElement('div');
  titleEl.className = 'flash-message__title';
  titleEl.innerHTML = title;
  wrapperEl.append(titleEl);

  if (text) {
    const textEl = document.createElement('div');
    textEl.className = 'flash-message__text';
    textEl.innerHTML = text;
    wrapperEl.append(textEl);
  }

  formWrapperEl.prepend(wrapperEl);
}

export function showFlashInfo(title, text = null, prependTo = '.form__wrapper') {
  return showFlashMessage(title, text, 'info', prependTo);
}

export function showFlashError(title, text = null, prependTo = '.form__wrapper') {
  return showFlashMessage(title, text, 'error', prependTo);
}

export function showFlashSuccess(title, text = null, prependTo = '.form__wrapper') {
  return showFlashMessage(title, text, 'success', prependTo);
}

/**
 * Adjust message positions
 */
export function adjustMessages() {
  let height = 0;

  const messages = Array.from(document.querySelectorAll('.message__container')).reverse();

  messages.forEach((item, index) => {
    if (index > 0) {
      height += item.offsetHeight;
      height += 8;
      item.style.marginBottom = `${height}px`;
    }
  });
}

/**
 * Main message function
 */
export function message(txt, color = 'default') {
  const container = document.createElement('div');
  container.className = `message__container -${color}`;
  container.innerHTML = txt;

  document.body.appendChild(container);

  // Animate in
  requestAnimationFrame(() => {
    container.offsetHeight;
    container.classList.add('-visible');
  });

  // Auto-close
  container.dataset.timer = setTimeout(() => {
    closeMessage(container);
  }, config.autoCloseMessages);

  // Limit number of visible messages
  const messages = document.querySelectorAll('.message__container:not([data-closing])');
  if (messages.length > config.maxMessages) {
    closeMessage(messages[0]);
  }

  // Manual close on click
  container.addEventListener('click', () => closeMessage(container));

  // Adjust positions
  adjustMessages();
}

/**
 * Close message function
 */
function closeMessage(container) {
  if (!container || container.dataset.closing) return;

  container.dataset.closing = '1';
  container.classList.add('-close');

  if (container.dataset.timer) {
    clearTimeout(parseInt(container.dataset.timer));
    delete container.dataset.timer;
  }

  setTimeout(() => {
    if (container.parentNode) {
      container.remove();
      adjustMessages();
    }
  }, config.defaultTransitionSpeed);
}

/**
 * Error message
 */
export function error(txt) {
  txt = txt || __('error');
  return message(txt, 'error');
}

/**
 * Success message
 */
export function success(txt) {
  return message(txt, 'success');
}

/**
 * Network error helper
 */
export function networkError(responseOrError) {
  const errorMessage = responseOrError && responseOrError.message ? responseOrError.message : null;

  if (responseOrError && typeof responseOrError.status === 'number') {
    const status = responseOrError.status;

    if (status === 0) return error(__('networkError'));
    if (status === 429) return error(__('tooManyRequests'));
    if (status === 419) return error(__('csrfExpired'));
    return error(errorMessage);
  }

  return error(errorMessage);
}
