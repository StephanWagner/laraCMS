export function select({
  id = '',
  name = '',
  value = '',
  placeholder = '',
  options = [],
  restrictOptions = {},
  disabled = false,
  required = false,
  readonly = false,
  size = 'default',
  className = '',
  icon = '',
  onChange = null,
  onFocus = null,
  onBlur = null,
} = {}) {
  // Wrapper
  const wrapper = document.createElement('div');
  wrapper.className = `input__container -select -size-${size} ${className}`.trim();

  // Pointer icon
    const painterIconEl = document.createElement('div');
    painterIconEl.className = 'select__pointer-icon icon';
    painterIconEl.textContent = 'keyboard_arrow_down';
    wrapper.appendChild(painterIconEl);

  // Optional icon
  let iconEl = null;
  if (icon) {
    wrapper.classList.add('-has-icon');
    iconEl = document.createElement('div');
    iconEl.className = 'textfield__icon icon';
    iconEl.textContent = icon;
    wrapper.appendChild(iconEl);
  }

  // Create select
  const selectEl = document.createElement('select');
  selectEl.className = 'textfield';
  if (id) selectEl.id = id;
  if (name) selectEl.name = name;
  selectEl.disabled = disabled;
  selectEl.required = required;
  selectEl.readOnly = readonly;

  // Optional placeholder
  if (placeholder) {
    const placeholderOption = document.createElement('option');
    placeholderOption.disabled = true;
    placeholderOption.selected = !value;
    placeholderOption.hidden = true;
    placeholderOption.textContent = placeholder;
    selectEl.appendChild(placeholderOption);
  }

  // Get current user role
  const userRole = window.app?.auth?.role || null;

  // Filter options
  const filteredOptions = options.filter(opt => {
    const restrictedTo = restrictOptions[opt.value];
    if (!restrictedTo) return true;
    return restrictedTo.includes(userRole);
  });

  // Populate options
  filteredOptions.forEach(opt => {
    const optEl = document.createElement('option');
    optEl.value = opt.value;
    optEl.textContent = opt.label;
    if (opt.value == value) optEl.selected = true;
    selectEl.appendChild(optEl);
  });

  // Focus / blur styling
  selectEl.addEventListener('focus', e => {
    wrapper.classList.add('-has-focus');
    if (onFocus) onFocus(e);
  });

  selectEl.addEventListener('blur', e => {
    wrapper.classList.remove('-has-focus');
    if (onBlur) onBlur(e);
  });

  selectEl.addEventListener('change', e => {
    selectEl.blur();
    if (onChange) onChange(e);
  });

  wrapper.appendChild(selectEl);
  wrapper._selectEl = selectEl;

  return wrapper;
}
