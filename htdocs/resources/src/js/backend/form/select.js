import $ from 'jquery';
import select2 from 'select2';

// Init select2
select2($);

// Init select fields
function initSelectFields() {
  $('[data-select-field]').each(function (index, item) {
    if (!$(item).data('select-field-initialized')) {
      $(item)
        .select2({
          minimumResultsForSearch: -1,
          width: '100%',
          closeOnSelect: true
        })
        .on('select2:open', function (ev) {
          $('input.select2-search__field').attr('placeholder', 'Search...');
        });
      $(item).data('select-field-initialized', true);
    }
  });
}
window.initSelectFields = initSelectFields;

// Domready
$(function () {
  // Init select fields
  initSelectFields();
});
