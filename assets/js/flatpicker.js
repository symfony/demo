import 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import l10n from "flatpickr/dist/l10n";

const lang = document.documentElement.getAttribute("lang") || "en";
const Locale = l10n.default[lang] || l10n.default;

flatpickr(".flatpickr", {
    allowInput: true,
    dateFormat: "Y-m-d H:i",
    enableTime: true,
    locale: Locale,
    time_24hr: true,
    wrap: true
});
