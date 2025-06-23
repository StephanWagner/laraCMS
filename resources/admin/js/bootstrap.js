import { initMenus } from "./components/menu";
import { initForms } from "./lib/form";
import { initInstall } from "./auth/install";
import { initLogin } from "./auth/login";
import { initResetPassword } from "./auth/reset-password";
import { initNewPassword } from "./auth/new-password";

document.addEventListener('DOMContentLoaded', () => {
  // Forms
  initForms();
  initInstall();
  initLogin();
  initResetPassword();
  initNewPassword();

  // Menus
  initMenus();
});
