import { apiFetch } from '../services/api-fetch';
import { networkError } from '../ui/message';
import { removeContainer } from '../utils/animate-remove';

/**
 * Init user settings
 */
export function initRemoveSystemWarning() {
  document.querySelectorAll('[data-remove-warning]').forEach(el => {
    const id = el.dataset.removeWarning;

    el.addEventListener('click', () => {
      saveUserSettings(
        {
          'ignore-system-warnings': {
            [id]: true,
          },
        },
        () => {
            removeContainer(el.closest('[data-warning="' + id + '"]'));
        },
        xhr => {
          networkError(xhr);
        }
      );
    });
  });
}

/**
 * Save user settings
 */
export function saveUserSettings(data, success, error) {
  return apiFetch({
    url: '/admin/api/save-user-settings',
    method: 'POST',
    headers: {
      Accept: 'application/json',
    },
    data: { data },
    success: response => {
      success && success(response);
      return response;
    },
    error: xhr => {
      error && error(xhr);
      return xhr;
    },
  });
}
