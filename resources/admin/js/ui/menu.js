import { config } from '../config/config';

// Variables
const timeouts = {};

export function initMenus() {
  document.querySelectorAll('[data-toggle-menu]').forEach((triggerEl) => {
    if (triggerEl._menuEventAdded) return;
    triggerEl.addEventListener('click', () => {
      triggerEl._menuEventAdded = true;
      const id = triggerEl.getAttribute('data-toggle-menu');
      menuIsOpen(id) ? closeMenu(id) : openMenu(id);
    });
  });
}

// Helpers
export function menuIsOpen(id) {
  const menuEl = document.querySelector(`[data-menu="${id}"]`);
  return menuEl?.classList.contains('-open');
}

export function openMenu(id, triggerId = null) {
  const triggerEl = document.querySelector(`[data-toggle-menu="${triggerId || id}"]`);
  const menuEl = document.querySelector(`[data-menu="${id}"]`);

  if (!triggerEl || !menuEl) {
    return;
  }

  triggerEl.classList.add('-active');
  menuEl.classList.add('-open', '-show');

  if (timeouts.closeMenuTimeout) {
    clearTimeout(timeouts.closeMenuTimeout);
  }

  requestAnimationFrame(() => {
    menuEl.classList.add('-animate');
    document.addEventListener('click', handleOutsideClick);
  });

  function handleOutsideClick(ev) {
    const isOverlay = ev.target.classList.contains('menu-overlay__wrapper');
    const insideOverlay = ev.target.closest('.menu-overlay__wrapper');

    if (!isOverlay && !insideOverlay) {
      closeMenu(id);
      document.removeEventListener('click', handleOutsideClick);
    }
  }
}

export function closeMenu(id, triggerId = null) {
  const triggerEl = document.querySelector(`[data-toggle-menu="${triggerId || id}"]`);
  const menuEl = document.querySelector(`[data-menu="${id}"]`);

  if (!menuEl || !menuEl.classList.contains('-open')) {
    return;
  }

  triggerEl?.classList.remove('-active');
  menuEl.classList.remove('-open', '-animate');

  timeouts.closeMenuTimeout = setTimeout(() => {
    menuEl.classList.remove('-show');
  }, config.defaultTransitionSpeed);
}
