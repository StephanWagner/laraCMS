import { config } from '../config/config';
import { __ } from './locale';

/**
 * Adjust message positions
 */
function adjustMessages() {
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
function message(txt, color = 'default') {
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
  const messages = document.querySelectorAll('.message__container');
  if (messages.length > config.maxMessages) {
    closeMessage(messages[0]);
  }

  /**
   * Close message function
   */
  function closeMessage(container) {
    if (container.dataset.closing) {
      return;
    }

    container.dataset.closing = '1';
    container.classList.add('-close');

    if (container.dataset.timer) {
      clearTimeout(parseInt(container.dataset.timer));
    }

    setTimeout(() => {
      container.remove();
      adjustMessages();
    }, config.defaultTransitionSpeed);
  }

  // Manual close on click
  container.addEventListener('click', () => closeMessage(container));

  // Adjust positions
  adjustMessages();
}

/**
 * Error message
 */
function error(txt) {
  txt = txt || __('admin::error');
  return message(txt, 'error');
}

/**
 * Success message
 */
function success(txt) {
  return message(txt, 'success');
}

/**
 * Network error helper
 */
function networkError(responseOrError) {
  if (responseOrError && typeof responseOrError.status === 'number') {
    const status = responseOrError.status;

    if (status === 429) return error(__('admin::tooManyRequests'));
    if (status === 419) return error(__('admin::csrfExpired'));
    return error(__('admin::error'));
  }

  return error(__('admin::networkError'));
}

export { message, error, success, networkError };
