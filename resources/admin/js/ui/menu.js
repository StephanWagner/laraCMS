import { config } from '../config/config';

// Variables
const menuTimeouts = {};
const menuHandlers = {};

/**
 * Initialize the menus
 */
export function initMenus() {
  document.querySelectorAll('[data-toggle-menu]').forEach(triggerEl => {
    if (triggerEl._menuEventAdded) return;
    triggerEl._menuEventAdded = true;
    triggerEl.addEventListener('click', () => {
      const id = triggerEl.getAttribute('data-toggle-menu');
      removeMenuHandler(id);
      menuIsOpen(id) ? closeMenu(id) : openMenu(id);
    });
  });
}

/**
 * Check if the menu is open
 *
 * @param {*} id
 * @returns
 */
export function menuIsOpen(id) {
  const menuEl = document.querySelector(`[data-menu="${id}"]`);
  return menuEl?.classList.contains('-open');
}

/**
 * Open the menu
 *
 * @param {*} id
 * @param {*} triggerId
 * @returns
 */
export function openMenu(id, triggerId = null) {
  const triggerEl = document.querySelector(`[data-toggle-menu="${triggerId || id}"]`);
  const menuEl = document.querySelector(`[data-menu="${id}"]`);
  if (!triggerEl || !menuEl) return;

  triggerEl.classList.add('-active');
  menuEl.classList.add('-open', '-show');

  if (menuTimeouts['closeMenuTimeout-' + id]) clearTimeout(menuTimeouts['closeMenuTimeout-' + id]);

  requestAnimationFrame(() => {
    menuEl.classList.add('-animate');

    removeMenuHandler(id);

    const handler = ev => {
      if (!menuEl.contains(ev.target) && !triggerEl.contains(ev.target)) {
        closeMenu(id);
      }
    };

    document.addEventListener('click', handler);
    menuHandlers[id] = handler;
  });
}

/**
 * Close the menu
 *
 * @param {*} id
 * @param {*} triggerId
 * @returns
 */
export function closeMenu(id, triggerId = null) {
  const triggerEl = document.querySelector(`[data-toggle-menu="${triggerId || id}"]`);
  const menuEl = document.querySelector(`[data-menu="${id}"]`);
  if (!menuEl || !menuEl.classList.contains('-open')) return;

  triggerEl?.classList.remove('-active');
  menuEl.classList.remove('-open', '-animate');

  menuTimeouts['closeMenuTimeout-' + id] = setTimeout(() => {
    menuEl.classList.remove('-show');
  }, config.defaultTransitionSpeed);

  removeMenuHandler(id);
}

/**
 * Remove the menu handler
 *
 * @param {*} id
 */
function removeMenuHandler(id) {
  if (menuHandlers[id]) {
    document.removeEventListener('click', menuHandlers[id]);
    delete menuHandlers[id];
  }
}
