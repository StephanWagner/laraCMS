import { config } from '../config/config';

/**
 * Variables
 */
let tooltipTimer = null;
let closeTimer = null;
let openTooltip = null;

/**
 * Initialize tooltips
 */
export function initTooltips() {
  const tooltipTriggerEls = document.querySelectorAll('[data-tooltip-trigger]');

  tooltipTriggerEls.forEach(tooltipTriggerEl => {
    if (tooltipTriggerEl._tooltipEventAdded) return;
    tooltipTriggerEl._tooltipEventAdded = true;

    const tooltipEl = tooltipTriggerEl.querySelector('[data-tooltip]');
    if (!tooltipEl) return;

    tooltipTriggerEl.addEventListener('mouseenter', () => {
      clearTimeout(closeTimer);

      if (openTooltip && openTooltip !== tooltipEl) {
        clearTimeout(tooltipTimer);
        openTooltip.classList.remove('-is-visible');
        tooltipEl.classList.add('-is-visible');
        adjustTooltipPosition(tooltipEl);
        openTooltip = tooltipEl;
        return;
      }

      if (!openTooltip) {
        tooltipTimer = setTimeout(() => {
          tooltipEl.classList.add('-is-visible');
          adjustTooltipPosition(tooltipEl);
          openTooltip = tooltipEl;
        }, config.tooltipDelay);
      }
    });

    tooltipTriggerEl.addEventListener('mouseleave', () => {
      clearTimeout(tooltipTimer);

      closeTimer = setTimeout(() => {
        tooltipEl.classList.remove('-is-visible');
        if (openTooltip === tooltipEl) {
          openTooltip = null;
        }
      }, config.tooltipCloseDelay);
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

  if (rect.left < config.tooltipPadding) {
    shiftX = -rect.left + config.tooltipPadding;
  } else if (rect.right > viewportWidth - config.tooltipPadding) {
    shiftX = viewportWidth - rect.right - config.tooltipPadding;
  }

  tooltipEl.style.marginLeft = `${shiftX}px`;
}
