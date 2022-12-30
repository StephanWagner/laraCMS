import $ from 'jquery';

function valueGetter(itemEl) {
  return $(itemEl).find('input').val();
}

export { valueGetter };
