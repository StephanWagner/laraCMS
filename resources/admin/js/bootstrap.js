import { initMenus } from "./components/menu";
import { initForms } from "./lib/form";
import { initLogin } from "./auth/login";
import { initInstall } from "./auth/install";

document.addEventListener('DOMContentLoaded', () => {
  // Forms
  initForms();
  initInstall();
  initLogin();

  // Menus
  initMenus();
});
