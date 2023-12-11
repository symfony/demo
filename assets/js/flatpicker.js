import 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import l10n from "flatpickr/dist/l10n";

flatpickr.defaultConfig.animate = window.navigator.userAgent.indexOf('MSIE') === -1;
let lang = document.documentElement.getAttribute('lang') || 'en';
const Locale = l10n[`${lang}`] || l10n.default;
flatpickr.localize(Locale);
const configs = {
    standard: {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        allowInput: true,
        time_24hr: true,
        defaultHour: 24,
        parseDate: (datestr, format) => {
            return flatpickr.parseDate(datestr, format);
        },
        formatDate: (date, format, locale) => {
            return flatpickr.formatDate(date, format);
        }
    }
};

const flatpickrs = document.querySelectorAll(".flatpickr");
for (let i = 0; i < flatpickrs.length; i++) {
    let element = flatpickrs[i];
    let configValue = configs[element.getAttribute("data-flatpickr-class")] || {};
    // Overrides the default format with the one sent by data attribute
    configValue.dateFormat = element.getAttribute("data-date-format") || 'Y-m-d H:i';
    // ...and then initialize the flatpickr
    flatpickr(element, configValue);
}
