// Exposes jQuery as a global variable
global.$ = global.jQuery = require('jquery');

// loads the Bootstrap jQuery plugins
import 'bootstrap-sass/assets/javascripts/bootstrap/dropdown.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/modal.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/transition.js';

// loads the code syntax highlighting library
import './highlight.js';

// loads the instant search library
import './jquery.instantSearch.js';
