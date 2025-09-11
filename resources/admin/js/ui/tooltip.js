import { config } from '../config/config';

/**
 * Variables
 */
let tooltipTimer = null;
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
      clearTimeout(tooltipTimer);

      // Close currently open tooltip if it's different
      if (openTooltip && openTooltip !== tooltipEl) {
        closeTooltip(openTooltip);
      }

      // If another tooltip is already open → open immediately
      if (openTooltip && openTooltip !== tooltipEl) {
        openTooltipEl(tooltipEl);
      } else if (!openTooltip) {
        // Otherwise use the delay
        tooltipTimer = setTimeout(() => {
          openTooltipEl(tooltipEl);
        }, config.tooltipDelay);
      }
    });

    tooltipTriggerEl.addEventListener('mouseleave', () => {
      clearTimeout(tooltipTimer);
      closeTooltip(tooltipEl);
    });
  });
}

/**
 * Open a tooltip
 */
function openTooltipEl(tooltipEl) {
  if (openTooltip === tooltipEl) return;

  tooltipEl.classList.add('-show');

  requestAnimationFrame(() => {
    adjustTooltipPosition(tooltipEl);
    tooltipEl.classList.add('-animate');
  });

  openTooltip = tooltipEl;
}

/**
 * Close a tooltip
 */
function closeTooltip(tooltipEl) {
  clearTimeout(tooltipEl._tooltipCloseTimer);

  tooltipEl.classList.remove('-animate');

  // Remove -show after transition ends
  tooltipEl._tooltipCloseTimer = setTimeout(() => {
    tooltipEl.classList.remove('-show');
    if (openTooltip === tooltipEl) {
      openTooltip = null;
    }
  }, config.defaultTransitionSpeed);
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
