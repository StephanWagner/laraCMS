/**
 * Adjust element horizontally so it doesn't overflow viewport or container
 *
 * @param {HTMLElement} el - The element to adjust
 * @param {Object} options
 * @param {number} [options.padding=8] - Min spacing from container edges
 * @param {HTMLElement} [options.container=window] - Limit within this element's rect (defaults to viewport)
 */
export function keepInBounds(el, { padding = 4, container = null, attribute = 'marginLeft'} = {}) {
  if (!el) return;

  el.style[attribute] = 0;

  const rect = el.getBoundingClientRect();
  const containerRect = container
    ? container.getBoundingClientRect()
    : { left: 0, right: window.innerWidth };

  let shiftX = 0;

  if (rect.left < containerRect.left + padding) {
    shiftX = containerRect.left + padding - rect.left;
  } else if (rect.right > containerRect.right - padding) {
    shiftX = containerRect.right - rect.right - padding;
  }

  if (attribute === 'marginRight') {
    shiftX = -shiftX;
  }

  el.style[attribute] = `${shiftX}px`;
}
