/**
 * Initialize tooltips
 */
export function initTooltips() {
  const tooltipTriggerEls = document.querySelectorAll('[data-tooltip-trigger]');

  tooltipTriggerEls.forEach(tooltipTriggerEl => {
    tooltipTriggerEl.addEventListener('mouseenter', e => {
      const tooltipEl = tooltipTriggerEl.querySelector('[data-tooltip]');
      adjustTooltipPosition(tooltipEl);
    });
  });
}

/**
 * Adjust tooltip position
 * 
 * @param {HTMLElement} tooltipEl
 */
export function adjustTooltipPosition(tooltipEl) {

  tooltipEl.style.marginLeft = 0;

  const rect = tooltipEl.getBoundingClientRect();
  const viewportWidth = window.innerWidth;
  let shiftX = 0;

  if (rect.left < 8) {
    shiftX = -rect.left + 8;
  } else if (rect.right > viewportWidth - 8) {
    shiftX = viewportWidth - rect.right - 8;
  }

  tooltipEl.style.marginLeft = `${shiftX}px`;
}
