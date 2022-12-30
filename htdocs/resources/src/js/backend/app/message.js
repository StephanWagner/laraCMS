import jBox from 'jBox';

/**
 * Show messages
 */

function message(color, txt) {
  new jBox('Notice', {
    color: color,
    stack: true,
    delayOnHover: false,
    autoClose: 6000,
    attributes: {
      x: 'right',
      y: 'bottom'
    },
    adjustDistance: {
      bottom: 8,
      right: 8
    },
    content: txt,
    stack: false,
    fade: 600,
    animation: {
      open: 'slide',
      close: 'zoomIn'
    }
  });
}

function error(txt) {
  message('red', txt || i18n['app.default-error-message']);
}

function ajaxError() {
  error();
}

function success(txt) {
  message('green', txt);
}

export { error, ajaxError, success };
