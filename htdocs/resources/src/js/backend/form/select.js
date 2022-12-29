import $ from 'jquery';
import select2 from 'select2';

// Init select2

select2($);

// Init select fields

function initSelectFields() {
  $('[data-select-field]:not(.-init)').each(function (index, item) {
    if (!$(item).data('select-field-initialized')) {
      $(item)
        .select2({
          // TODO dynamic options
          minimumResultsForSearch: -1,
          width: '100%',
          closeOnSelect: true
        })
        .on('select2:open', function (ev) {
          // TODO dynamic text
          $('input.select2-search__field').attr('placeholder', 'Search...');
        });
      $(item).trigger('change');
      $(item).addClass('-init');
    }
  });
}

// Domready

$(function () {
  // Init select fields
  initSelectFields();
});
