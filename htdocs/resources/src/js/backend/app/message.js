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
    position: {
      x: 12,
      y: 12
    },
    responsivePositions: {
      600: {
        x: 8,
        y: 8
      }
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
  message('red', txt || i18n['app.error-message-default']);
}

function ajaxError() {
  error();
}

function success(txt) {
  message('green', txt);
}

/**
 * Export
 */

export { error, ajaxError, success };
