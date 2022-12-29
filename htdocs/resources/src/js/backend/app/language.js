import $ from 'jquery';

function getLocale() {

}

// Translate strings

function __(id, rep, lang) {
  var str = app.locale[id][lang || app.language || 'en'];
  rep &&
    $.each(rep, function (index, replace) {
      str = str.replace('{' + index + '}', replace);
    });
  return str;
}
