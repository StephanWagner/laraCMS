export function textarea({
  id = '',
  name = '',
  value = '',
  placeholder = '',
  maxlength = null,
  rows = 3,
  required = false,
  disabled = false,
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

  if (required) wrapper.classList.add('-required');
  if (disabled) wrapper.classList.add('-disabled');
  if (readonly) wrapper.classList.add('-readonly');

  // Create textarea
  const textareaEl = document.createElement('textarea');

  // Basic attributes
  if (id) textareaEl.id = id;
  if (name) textareaEl.name = name;
  if (placeholder) textareaEl.placeholder = placeholder;
  if (maxlength) inputEl.maxLength = maxlength;
  textareaEl.rows = rows;
  textareaEl.value = value;
  textareaEl.disabled = disabled;
  textareaEl.readOnly = readonly;

  // Classes
  textareaEl.className = `textfield textfield--textarea ${className}`.trim();

  // Handle focus/blur styling
  textareaEl.addEventListener('focus', e => {
    wrapper.classList.add('-has-focus');
    if (onFocus) onFocus(e);
  });

  textareaEl.addEventListener('blur', e => {
    wrapper.classList.remove('-has-focus');
    if (onBlur) onBlur(e);
  });

  // Other listener
  const checkHasValue = () => {
    if (inputEl.value) {
      wrapper.classList.add('-has-value');
    } else {
      wrapper.classList.remove('-has-value');
    }
  };

  inputEl.addEventListener('input', () => {
    checkHasValue();
    if (onInput) onInput();
  });

  inputEl.addEventListener('change', () => {
    checkHasValue();
    if (onChange) onChange();
  });

  checkHasValue();

  wrapper.appendChild(textareaEl);

  wrapper._input = textareaEl;

  return textarea;
}
