import { apiFetch } from '../services/api-fetch';
import { networkError, success } from '../ui/message';
import { initFormEvents } from './events';
import { input } from './input';
import { getNestedValue } from '../utils/object';

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
    // Container
    this.container = document.createElement('div');
    this.container.className = 'form__container';

    const formConfig = this.formData?.config;
    const formItems = formConfig?.form || [];
    const item = this.formData?.item || null;
    const texts = this.formData?.texts || {};

    formItems.forEach(formItem => {
      console.log(formItem);

      const inputOptions = formItem.inputOptions;

      if (item && formItem.source) {
        inputOptions.value = getNestedValue(item, formItem.source) || null;
      }

      const inputContainerEl = input({
        label: formItem.label ? resolveText(texts, formItem.label) : null,
        description: formItem.description ? resolveText(texts, formItem.description) : null,
        inputOptions,
      });

      this.container.appendChild(inputContainerEl);
    });

    this.wrapper.appendChild(this.container);

    initFormEvents();
  }

  saveData(params = {}) {
    if (this.saving) return false;

    const formConfig = this.formData?.config || {};

    apiFetch({
      url: '/admin/api/form',
      data: {
        id: null, // TODO
      },
      before: () => {
        this.saving = true;
      },
      complete: () => {
        this.saving = false;
      },
      success: response => {
        if (response.success) {
          // TODO
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

function resolveText(texts, textId) {
  return getNestedValue(texts, textId) ?? textId;
}
