import { apiFetch } from '../services/api-fetch';
import { networkError, success } from '../ui/message';
import { initFormEvents } from './events';
import { input } from './input';
import { getNestedValue } from '../utils/object';
import { showFlashInfo, showFlashSuccess } from '../ui/message';
import { animate } from '../utils/animate';

export class FormService {
  constructor({ key, wrapper }) {
    if (!key || !wrapper) return;

    this.key = key;
    this.wrapper = wrapper;

    this.formData = window.formData || null;

    // TODO if form data is missing, get form data then init

    this.init();
  }

  init() {
    this.container = document.createElement('div');
    this.container.className = 'form__container';

    const formConfig = this.formData?.config;

    if (!formConfig) {
      return console.warn('No form config found.');
    }

    const formItems = formConfig?.form || [];
    const item = this.formData?.item || null;
    const texts = this.formData?.texts || {};

    const inputIdContainerEl = input({
      key: formConfig.key,
      source: 'id',
      inputOptions: {
        type: 'hidden',
        name: 'id',
        value: item ? item.id : null,
      },
    });
    this.container.appendChild(inputIdContainerEl);

    formItems.forEach(formItem => {
      const inputOptions = formItem.inputOptions;

      if (item && formItem.source) {
        inputOptions.value = getNestedValue(item, formItem.source) || null;
      }

      if (!item && inputOptions.requiredIfNew) {
        inputOptions.required = true;
      }

      const inputContainerEl = input({
        key: formConfig.key,
        source: formItem.source,
        label: formItem.label ? resolveText(texts, formItem.label) : null,
        description: formItem.description ? resolveText(texts, formItem.description) : null,
        inputOptions,
        clearErrorOnInput: true,
      });

      this.container.appendChild(inputContainerEl);
    });

    this.wrapper.appendChild(this.container);

    initFormEvents();

    // Save form events
    const saveButton = document.querySelector('[data-save-form="' + formConfig.key + '"]');

    if (saveButton) {
      saveButton.addEventListener('click', () => {
        this.saveForm();
      });
    }
  }

  saveForm() {
    if (this.saving) return false;

    const formConfig = this.formData?.config || {};
    const key = formConfig.key;
    const saveButton = document.querySelector('[data-save-form="' + key + '"]');

    apiFetch({
      url: '/admin/api/save-form',
      data: {
        key,
        values: getFormData(key),
      },
      before: () => {
        this.saving = true;
        saveButton.disabled = true;
        saveButton.classList.add('-loading');
      },
      complete: () => {
        this.saving = false;
        saveButton.disabled = false;
        saveButton.classList.remove('-loading');
      },
      success: response => {
        if (response.success) {
          animate(saveButton, 'pulseUpSmall');
          response.successText && showFlashSuccess(response.successText);
          document.querySelector(
            '[data-form-value="' + key + '"][data-input-source="id"] input'
          ).value = response.item.id;
          history.pushState(null, '', response.editRoute);
        } else if (response.error) {
          animate(saveButton, 'shake');
          response.errorTitle ? showFlashInfo(response.errorTitle, response.errorText) : error();
          response.inputErrors && showFormErrors(key, response.inputErrors);
        } else {
          networkError(response);
        }
      },
      error: xhr => {
        networkError(xhr);
      },
    });
  }
}

/**
 * Resolve text
 */
function resolveText(texts, textId) {
  return getNestedValue(texts, textId) ?? textId;
}

/**
 * Get form data
 */
function getFormData(key) {
  const data = {};

  const fields = document.querySelectorAll('[data-form-value="' + key + '"]');
  fields.forEach(wrapper => {
    const source = wrapper.dataset.inputSource;
    const type = wrapper.dataset.inputType;

    // Support various input types
    let value = null;

    if (type === 'textfield' || type === 'textarea' || type === 'email' || type === 'number') {
      const input = wrapper.querySelector('input, textarea');
      value = input?.value || '';
    } else if (type === 'checkbox') {
      const input = wrapper.querySelector('input[type="checkbox"]');
      value = input?.checked || false;
    } else if (type === 'select') {
      const select = wrapper.querySelector('select');
      if (select?.multiple) {
        value = Array.from(select.selectedOptions).map(opt => opt.value);
      } else {
        value = select?.value || '';
      }
    } else {
      const input = wrapper.querySelector('input, textarea, select');
      value = input?.value || '';
    }

    data[source] = value;
  });

  return data;
}

/**
 * Show form errors
 */
function showFormErrors(key, errors = {}) {
  Object.entries(errors).forEach(([source, messages]) => {
    const element = document.querySelector(
      '[data-form-value="' + key + '"][data-input-source="' + source + '"]'
    );
    if (!element) return;

    element.querySelector('.input__container')?.classList.add('-error');

    const existingError = element.querySelector('.input__error');
    if (existingError) {
      existingError.remove();
    }

    const errorEl = document.createElement('div');
    errorEl.className = 'input__error';
    errorEl.innerHTML = messages[0];

    element.appendChild(errorEl);
  });
}
