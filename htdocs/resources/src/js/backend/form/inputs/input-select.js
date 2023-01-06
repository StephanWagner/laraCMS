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
  $('[data-select-field][data-html]:not(data-html-select-field-init)').each(
    function (index, item) {
      const hasSearch = $(this)[0].hasAttribute('data-search');
      // prettier-ignore
      const minimumResultsForSearch = $(this)[0].hasAttribute('data-minimun-options-for-search') ? (parseInt($(this).attr('data-minimun-options-for-search')) || -1) : 10;
      const searchPlaceholder = $(this).attr(
        'data-select-field-search-placeholder'
      );

      console.log(hasSearch, minimumResultsForSearch, searchPlaceholder);

      const selectField = $(item).select2({
        minimumResultsForSearch: hasSearch ? minimumResultsForSearch : -1,
        width: '100%',
        closeOnSelect: true
      });

      // Add search placeholder
      if (searchPlaceholder) {
        selectField.on('select2:open', function (ev) {
          $('input.select2-search__field').attr(
            'placeholder',
            searchPlaceholder
          );
        });
      }

      // Init
      $(item).trigger('change');
      $(item).attr('data-html-select-field-init', '');
    }
  );
}

/**
 * Domready
 */

$(function () {
  // Init select fields
  initSelectFields();
});

/**
 * Export
 */

export { initSelectFields };
