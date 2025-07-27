export function input({ label, inputEl, description }) {
  const wrapperEl = document.createElement('div');
  wrapperEl.className = 'input__container';

  if (label) {
    const labelEl = document.createElement('label');
    labelEl.className = 'input__label';
    labelEl.innerHTML = label;
    wrapperEl.appendChild(labelEl);
  }

  wrapperEl.appendChild(inputEl);

  if (description) {
    const descEl = document.createElement('div');
    descEl.className = 'input__description';
    descEl.innerHTML = description;
    wrapperEl.appendChild(descEl);
  }

  return wrapperEl;
}
