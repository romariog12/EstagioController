/* =========================================================
 * bootstrap-datepicker-globalize.js
 * https://github.com/scott-xu/bootstrap-datepicker-globalize
 * =========================================================
 * Copyright 2013 Scott Xu
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */

(function ($, Globalize) {
    if (Globalize) {
        var language = window.language || $("html").attr("lang") || $("html").data("lang") || navigator.language || navigator.browserLanguage;
        var culture = Globalize.culture(language);

        $.fn.datepicker.dates[culture.name] = {
            days: culture.calendar.days.names,
            daysShort: culture.calendar.days.namesAbbr,
            daysMin: culture.calendar.days.namesShort,
            months: culture.calendar.months.names,
            monthsShort: culture.calendar.months.namesAbbr,
            today: Globalize.localize("today") || "Today",
            format: "d",
            rtl: !!culture.isRTL,
            weekStart: culture.calendar.firstDay || 0
        }

        $.extend($.fn.datepicker.defaults, {
            language: culture.name
        });

        $.extend($.fn.datepicker.DPGlobal, {
            parseFormat: function (format) {
                return format;
            },
            formatDate: function (date, format) {
                return Globalize.format(date, format);
            },
            parseDate: function (date, format) {
                return Globalize.parseDate(date, format) || new Date();
            }
        });
    }
}(window.jQuery, window.Globalize))