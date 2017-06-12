var $ = require('jquery');
window.$ = $;
window.jQuery = $;

require('bootstrap-sass/assets/javascripts/bootstrap/dropdown.js');
require('bootstrap-sass/assets/javascripts/bootstrap/modal.js');
require('bootstrap-sass/assets/javascripts/bootstrap/transition.js');

var hljs = require('highlight.js');
hljs.registerLanguage('php', require('highlight.js/lib/languages/php'));
hljs.registerLanguage('twig', require('highlight.js/lib/languages/twig'));
window.hljs = hljs;
hljs.initHighlightingOnLoad();
