
export function textarea({
  id = '',
  name = '',
  value = '',
  placeholder = '',
  rows = 3,
  disabled = false,
  required = false,
  readonly = false,
  size = 'default',
  className = '',
  onInput = null,
  onChange = null,
  onFocus = null,
  onBlur = null,
} = {}) {
  // Create wrapper
  const wrapper = document.createElement('div');
  wrapper.className = `input__container -textarea -size-${size} ${className}`.trim();

  // Create textarea
  const textareaEl = document.createElement('textarea');

  // Basic attributes
  if (id) textareaEl.id = id;
  if (name) textareaEl.name = name;
  if (placeholder) textareaEl.placeholder = placeholder;
  textareaEl.rows = rows;
  textareaEl.value = value;
  textareaEl.disabled = disabled;
  textareaEl.required = required;
  textareaEl.readOnly = readonly;

  // Classes
  textareaEl.className = `textfield textfield--textarea ${className}`.trim();

  // Handle focus/blur styling
  textareaEl.addEventListener('focus', (e) => {
    wrapper.classList.add('-has-focus');
    if (onFocus) onFocus(e);
  });

  textareaEl.addEventListener('blur', (e) => {
    wrapper.classList.remove('-has-focus');
    if (onBlur) onBlur(e);
  });

  // Other listener
  if (onInput) textareaEl.addEventListener('input', onInput);
  if (onChange) textareaEl.addEventListener('change', onChange);

  wrapper.appendChild(textareaEl);

  wrapper._input = textareaEl;

  return textarea;
}
