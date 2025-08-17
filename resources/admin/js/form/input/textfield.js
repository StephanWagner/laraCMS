import { clearInputError } from "../input";

export function textfield({
  type = 'text',
  id = '',
  name = '',
  value = '',
  placeholder = '',
  autocomplete = '',
  maxlength = null,
  disabled = false,
  required = false,
  readonly = false,
  size = 'default',
  className = '',
  icon = '',
  onInput = null,
  onChange = null,
  onFocus = null,
  onBlur = null,
  clearErrorOnInput = false,
  onEnter = null,
} = {}) {
  // Create wrapper
  const wrapper = document.createElement('div');
  wrapper.className = `input__container -textfield -size-${size} ${className}`.trim();

  if (required) wrapper.classList.add('-required');
  if (disabled) wrapper.classList.add('-disabled');
  if (readonly) wrapper.classList.add('-readonly');

  // Optional icon
  let iconEl = null;
  if (icon) {
    wrapper.classList.add('-has-icon');
    iconEl = document.createElement('div');
    iconEl.className = 'textfield__icon icon';
    iconEl.textContent = icon;
    wrapper.appendChild(iconEl);
  }

  // Create input
  const inputEl = document.createElement('input');
  inputEl.className = 'textfield';
  inputEl.type = type;
  if (id) inputEl.id = id;
  if (name) inputEl.name = name;
  if (placeholder) inputEl.placeholder = placeholder;
  if (autocomplete) inputEl.autocomplete = autocomplete;
  if (maxlength) inputEl.maxLength = maxlength;
  inputEl.value = value;
  inputEl.disabled = disabled;
  inputEl.readOnly = readonly;

  // Handle focus/blur styling
  inputEl.addEventListener('focus', e => {
    wrapper.classList.add('-has-focus');
    if (onFocus) onFocus(e);
  });

  inputEl.addEventListener('blur', e => {
    wrapper.classList.remove('-has-focus');
    if (onBlur) onBlur(e);
  });

  const checkHasValue = () => {
    if (inputEl.value) {
      wrapper.classList.add('-has-value');
    } else {
      wrapper.classList.remove('-has-value');
    }
  };

  inputEl.addEventListener('input', () => {
    clearErrorOnInput && clearInputError(inputEl);
    checkHasValue();
    if (onInput) onInput();
  });

  inputEl.addEventListener('change', () => {
    clearErrorOnInput && clearInputError(inputEl);
    checkHasValue();
    if (onChange) onChange();
  });

  inputEl.addEventListener('keydown', e => {
    if (e.key === 'Enter' && onEnter) {
      onEnter();
    }
  });

  checkHasValue();

  wrapper.appendChild(inputEl);

  wrapper._inputEl = inputEl;

  return wrapper;
}
