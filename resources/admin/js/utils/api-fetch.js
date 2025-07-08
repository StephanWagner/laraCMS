import { getCsrfToken } from './csrf';

export function apiFetch(options) {
  const {
    url,
    method = 'POST',
    data = null,
    headers = {},
    before,
    complete,
    success,
    error,
  } = options;

  const xhr = new XMLHttpRequest();
  xhr.open(method, url, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.setRequestHeader('Accept', 'application/json');

  // Add CSRF token
  const csrfToken = getCsrfToken();
  if (csrfToken) {
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  }

  // Custom headers
  for (const key in headers) {
    if (headers.hasOwnProperty(key)) {
      xhr.setRequestHeader(key, headers[key]);
    }
  }

  xhr.onload = function () {
    let response;
    try {
      response = JSON.parse(xhr.responseText);
    } catch (e) {
      response = xhr.responseText;
    }

    if (typeof success === 'function') success(response, xhr);
    if (typeof complete === 'function') complete(xhr);
  };

  xhr.onerror = function () {
    if (typeof error === 'function') error(xhr);
    if (typeof complete === 'function') complete(xhr);
  };

  if (typeof before === 'function') before();

  xhr.send(data ? JSON.stringify(data) : null);
}

export function getNetworkErrorId(xhr) {
  if (xhr && xhr.status === 0) return 'networkError';
  if (xhr && xhr.status === 429) return 'tooManyRequests';
  if (xhr && xhr.status === 419) return 'csrfExpired';
  return 'global';
}
