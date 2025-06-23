import { error, networkError } from './message';
import { getCsrfToken } from './csrf';
import { __ } from './locale';

async function apiFetch(endpoint, {
  method = 'POST',
  data = {},
  csrf = true,
  headers = {},
  onSuccess = null,
  onError = null
} = {}) {
  try {
    const fetchHeaders = {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      ...headers
    };

    if (csrf) {
      const csrfToken = getCsrfToken();
      if (csrfToken) {
        fetchHeaders['X-CSRF-TOKEN'] = csrfToken;
      }
    }

    const response = await fetch(endpoint, {
      method,
      headers: fetchHeaders,
      body: JSON.stringify(data)
    });

    const contentType = response.headers.get('Content-Type') || '';
    let responseData;

    if (contentType.includes('application/json')) {
      responseData = await response.json();
    } else {
      responseData = await response.text();
    }

    if (!response.ok) {
      if (onError) {
        onError(responseData);
      } else {
        error(responseData?.message || __('error'));
      }
      return;
    }

    // Handle app-level success flag
    if (
      typeof responseData === 'object' &&
      (
        responseData.success === false ||
        responseData.error === true
      )
    ) {
      if (onError) {
        onError(responseData);
      } else {
        error(responseData.message || __('error'));
      }
      return;
    }

    if (onSuccess) {
      onSuccess(responseData);
    }

    return responseData;
  } catch (err) {
    networkError(err);
  }
}

export { apiFetch }
