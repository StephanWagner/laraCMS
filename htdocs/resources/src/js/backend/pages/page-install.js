import $ from 'jquery';

/**
 * Domready
 */

$(function () {
  // Change language
  const selectEl = $('[data-form="install"] select[name="language"]');
  selectEl.on('change', function () {
    const languageId = $(this).val();
    window.location.href = '/admin/install?lang=' + languageId;
  });

  // Success callback
  const formEl = $('[data-form="install"]');
  formEl.data('successCallback', function () {
    window.location.href = '/admin';
  });
});
