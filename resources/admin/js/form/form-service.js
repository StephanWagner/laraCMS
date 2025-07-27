import { apiFetch } from '../services/api-fetch';
import { networkError, success } from '../ui/message';
import { initFormEvents } from './events';
import { textfield } from './input/textfield';
import { input } from './input';

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

    formItems.forEach(formItem => {
      console.log(formItem);

      let inputContainerEl;
      let inputEl;

      switch (formItem.type) {
        case 'textfield':
          inputEl = textfield(formItem.inputOptions);
          break;
      }

      if (inputEl) {
        inputContainerEl = input({
          label: formItem.label,
          description: formItem.description,
          inputEl
        });
      }

      if (inputContainerEl) {
        this.container.appendChild(inputContainerEl);
      }
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
