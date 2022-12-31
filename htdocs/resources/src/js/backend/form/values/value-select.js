import $ from 'jquery';

function valueGetter(itemEl) {
  return $(itemEl).find('select').val();
}

export { valueGetter };
