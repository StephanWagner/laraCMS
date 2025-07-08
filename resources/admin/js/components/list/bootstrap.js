import { ListView } from './list-view';

export function initList() {
  const wrapper = document.querySelector('.list__wrapper');
  if (!wrapper) return;

  const endpoint = wrapper.getAttribute('data-endpoint');
  if (!endpoint) return;

  new ListView({
    wrapper,
    endpoint,
  });
}
