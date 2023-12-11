// bootstrap-tagsinput is old and requires a global jQuery object
// this is done in a separate file so it will fully run before the rest
// of the code (i.e. the code that imports bootstrap-tagsinput)
import $ from 'jquery';
window.jQuery = $;
