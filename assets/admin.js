import './styles/admin.scss';
import 'typeahead.js';
import Bloodhound from "bloodhound-js";
import 'bootstrap-tagsinput';
import 'flatpickr';
import 'flatpickr/dist/flatpickr.css';
import moment from 'moment';

$(function() {
    // Bootstrap-tagsinput initialization
    // https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/
    var $input = $('input[data-toggle="tagsinput"]');
    if ($input.length) {
        var source = new Bloodhound({
            local: $input.data('tags'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            datumTokenizer: Bloodhound.tokenizers.whitespace
        });
        source.initialize();

        $input.tagsinput({
            trimValue: true,
            focusClass: 'focus',
            typeaheadjs: {
                name: 'tags',
                source: source.ttAdapter()
            }
        });
    }

    const locale = $('#post_publishedAt').data('date-locale');
    const Locale = require(`flatpickr/dist/l10n/${locale}.js`).default[locale];
    flatpickr.localize(Locale);

    $('[data-toggle="datetimepicker"]').flatpickr({
        enableTime: true,
        dateFormat: $('#post_publishedAt').data('date-format'),
        allowInput: true,
        parseDate: (datestr, format) => {
            return moment(datestr, format, true).toDate();
        },
        formatDate: (date, format, locale) => {
            return moment(date).format(format);
        }
    });
});

// Handling the modal confirmation message.
$(document).on('submit', 'form[data-confirmation]', function (event) {
    var $form = $(this),
        $confirm = $('#confirmationModal');

    if ($confirm.data('result') !== 'yes') {
        //cancel submit event
        event.preventDefault();

        $confirm
            .off('click', '#btnYes')
            .on('click', '#btnYes', function () {
                $confirm.data('result', 'yes');
                $form.find('input[type="submit"]').attr('disabled', 'disabled');
                $form.trigger('submit');
            })
            .modal('show');
    }
});
