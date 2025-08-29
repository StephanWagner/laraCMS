import { initMenus } from './ui/menu';
import { initInstall } from './auth/install';
import { initLogin } from './auth/login';
import { initResetPassword } from './auth/reset-password';
import { initNewPassword } from './auth/new-password';
import { initList } from './list/bootstrap';
import { initForm } from './form/bootstrap';
import { initFormEvents } from './form/events';
import { initFileUpload } from './form/file-upload';
import { initModals } from './ui/modal';
import { initProfilePage } from './pages/profile';

document.addEventListener('DOMContentLoaded', () => {
  // Forms
  initForm();
  initInstall();
  initLogin();
  initResetPassword();
  initNewPassword();
  initFormEvents();
  initFileUpload();

  // Menus
  initMenus();

  // List
  initList();

  // Modals
  initModals();

  // Pages
  initProfilePage();
});
