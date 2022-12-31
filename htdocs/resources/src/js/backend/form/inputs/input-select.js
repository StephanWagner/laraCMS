import $ from 'jquery';
import select2 from 'select2';

/**
 * Init select2
 */

select2($);

/**
 * Init select fields
 */

function initSelectFields() {
  $('[data-select-field][data-html]:not(.-init)').each(function (index, item) {
    // prettier-ignore
    const minimumResultsForSearch = $(this)[0].hasAttribute('data-select-field-search-min-results') ? parseInt($(this).attr('data-select-field-search-min-results')) : -1;
    const searchPlaceholder = $(this).attr(
      'data-select-field-search-placeholder'
    );

    const selectField = $(item).select2({
      minimumResultsForSearch: minimumResultsForSearch,
      width: '100%',
      closeOnSelect: true
    });

    // Add search placeholder
    if (searchPlaceholder) {
      selectField.on('select2:open', function (ev) {
        $('input.select2-search__field').attr('placeholder', searchPlaceholder);
      });
    }

    // Init
    $(item).trigger('change');
    $(item).addClass('-init');
  });
}

/**
 * Domready
 */

$(function () {
  // Init select fields
  initSelectFields();
});
