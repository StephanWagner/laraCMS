import $ from 'jquery';

/**
 * Animate elements
 */

const animationSpeeds = {
  tada: 1000,
  tadaSmall: 1000,
  flash: 500,
  shake: 400,
  pulseUpSmall: 400,
  pulseUp: 250,
  pulseDown: 250,
  popIn: 250,
  popOut: 250,
  fadeIn: 200,
  fadeOut: 200
};

function animateEl(element, animation, complete) {
  if (!element instanceof $ || !$(element).length || !animation) {
    return null;
  }

  if (element.data('animating')) {
    element.removeClass(element.data('animating')).data('animating', null);
    element.data('animationTimeout') &&
      clearTimeout(element.data('animationTimeout'));
  }

  element
    .addClass('animated-' + animation)
    .data('animating', 'animated-' + animation);
  element.data(
    'animationTimeout',
    setTimeout(function () {
      element.removeClass(element.data('animating')).data('animating', null);
      complete && complete();
    }, animationSpeeds[animation])
  );
}

/**
 * Export
 */

export { animateEl };
