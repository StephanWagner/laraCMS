import { config } from '../config';

// Variables
const timeouts = {};

function initMenus() {
  document.querySelectorAll('[data-toggle-menu]').forEach((triggerEl) => {
    triggerEl.addEventListener('click', () => {
      const id = triggerEl.getAttribute('data-toggle-menu');
      menuIsOpen(id) ? closeMenu(id) : openMenu(id);
    });
  });
}

// Helpers
function menuIsOpen(id) {
  const menuEl = document.querySelector(`[data-menu="${id}"]`);
  return menuEl?.classList.contains('-open');
}

function openMenu(id) {
  const triggerEl = document.querySelector(`[data-toggle-menu="${id}"]`);
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
    const isOverlay = ev.target.classList.contains('menu-overlay');
    const insideOverlay = ev.target.closest('.menu-overlay');

    if (!isOverlay && !insideOverlay) {
      closeMenu(id);
      document.removeEventListener('click', handleOutsideClick);
    }
  }
}

function closeMenu(id) {
  const triggerEl = document.querySelector(`[data-toggle-menu="${id}"]`);
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

export { initMenus, closeMenu };
