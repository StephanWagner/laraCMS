export function textfield({
  id = '',
  name = '',
  value = '',
  placeholder = '',
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
} = {}) {
  // Create wrapper
  const wrapper = document.createElement('div');
  wrapper.className = `textfield__container -textfield -size-${size} ${className}`.trim();

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
  inputEl.type = 'text';
  if (id) inputEl.id = id;
  if (name) inputEl.name = name;
  if (placeholder) inputEl.placeholder = placeholder;
  inputEl.value = value;
  inputEl.disabled = disabled;
  inputEl.required = required;
  inputEl.readOnly = readonly;

  // Handle focus/blur styling
  inputEl.addEventListener('focus', (e) => {
    wrapper.classList.add('-has-focus');
    if (onFocus) onFocus(e);
  });

  inputEl.addEventListener('blur', (e) => {
    wrapper.classList.remove('-has-focus');
    if (onBlur) onBlur(e);
  });

  // Other listener
  if (onInput) inputEl.addEventListener('input', onInput);
  if (onChange) inputEl.addEventListener('change', onChange);

  wrapper.appendChild(inputEl);

  wrapper._inputEl = inputEl;

  return wrapper;
}
