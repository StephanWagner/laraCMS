import { ListView } from './list-view';

export function initList() {
  const wrapper = document.querySelector('[data-list]');
  if (!wrapper) return;

  const key = wrapper.getAttribute('data-list');

  new ListView({
    key,
    wrapper,
  });
}
