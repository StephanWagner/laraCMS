import { textfield } from './input/textfield';
import { textarea } from './input/textarea';
import { select } from './input/select';

const inputTypes = {
  textfield,
  textarea,
  select,
};

export function input({ formId = null, label, description, inputEl, inputOptions = {} }) {
  const wrapperEl = document.createElement('div');
  wrapperEl.className = 'input__wrapper';

  if (formId) {
    wrapperEl.dataset.formValue = '';
  }

  if (inputOptions && inputOptions.name) {
    wrapperEl.dataset.inputName = inputOptions.name;
  }

  if (inputOptions && inputOptions.type) {
    wrapperEl.dataset.inputType = inputOptions.type;
  }

  if (label) {
    const labelEl = document.createElement('label');
    labelEl.className = 'input__label';
    labelEl.innerHTML = label;

    if (inputOptions.id) {
      labelEl.setAttribute('for', inputOptions.id);
    }

    wrapperEl.appendChild(labelEl);
  }

  if (inputEl) {
    wrapperEl.appendChild(inputEl);
  } else if (inputOptions) {
    const { type } = inputOptions;
    const factory = inputTypes[type];

    if (factory) {
      const factoryInputEl = factory(inputOptions);
      wrapperEl.appendChild(factoryInputEl);
    }
  }

  if (description) {
    const descEl = document.createElement('div');
    descEl.className = 'input__description';
    descEl.innerHTML = description;
    wrapperEl.appendChild(descEl);
  }

  return wrapperEl;
}
