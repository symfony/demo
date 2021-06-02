import './js/jquery.instantSearch.js';

$(function() {
    $('.search-field')
        .instantSearch({
            delay: 100,
        })
        .keyup();
});
