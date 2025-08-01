import { config } from '../config/config';
import { __ } from '../utils/locale';

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
  if (responseOrError && typeof responseOrError.status === 'number') {
    const status = responseOrError.status;

    if (status === 0) return error(__('networkError'));
    if (status === 429) return error(__('tooManyRequests'));
    if (status === 419) return error(__('csrfExpired'));
    return error();
  }

  return error();
}
