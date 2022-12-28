import $ from 'jquery';
import select2 from 'select2';

select2($);

function initSelectFields() {
  $('[data-select-field]').each(function (index, item) {
    if (!$(item).data('select-field-initialized')) {
      $(item).select2({
        minimumResultsForSearch: -1,
        width: '100%',
        closeOnSelect: true
      });
      $(item).data('select-field-initialized', true);
    }
  });
}
window.initSelectFields = initSelectFields;

$(function () {
  initSelectFields();
});
