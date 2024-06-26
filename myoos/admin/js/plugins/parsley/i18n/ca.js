/*!
* Parsleyjs
* Guillaume Potier - <guillaume@wisembly.com>
* Version 2.2.0-rc2 - built Tue Oct 06 2015 10:20:13
* MIT Licensed
*
*/
!(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module depending on jQuery.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Register plugin with global jQuery object.
        factory(jQuery);
    }
}(function ($) {
    // small hack for requirejs if jquery is loaded through map and not path
    // see http://requirejs.org/docs/jquery.html
    if ('undefined' === typeof $ && 'undefined' !== typeof window.jQuery) {
        $ = window.jQuery;
    }
    // ParsleyConfig definition if not already set
    window.ParsleyConfig = window.ParsleyConfig || {};
    window.ParsleyConfig.i18n = window.ParsleyConfig.i18n || {};
    // Define then the messages
    window.ParsleyConfig.i18n.ca = jQuery.extend(
        window.ParsleyConfig.i18n.ca || {}, {
            defaultMessage: "Aquest valor sembla ser invàlid.",
            type: {
                email:        "Aquest valor ha de ser una adreça de correu electrònic vàlida.",
                url:          "Aquest valor ha de ser una URL vàlida.",
                number:       "Aquest valor ha de ser un nombre vàlid.",
                integer:      "Aquest valor ha de ser un nombre enter vàlid.",
                digits:       "Aquest valor només pot contenir dígits.",
                alphanum:     "Aquest valor ha de ser alfanumèric."
            },
            notblank:       "Aquest valor no pot ser buit.",
            required:       "Aquest valor és obligatori.",
            pattern:        "Aquest valor és incorrecte.",
            min:            "Aquest valor no pot ser menor que %s.",
            max:            "Aquest valor no pot ser major que %s.",
            range:          "Aquest valor ha d'estar entre %s i %s.",
            minlength:      "Aquest valor és massa curt. La longitud mínima és de %s caràcters.",
            maxlength:      "Aquest valor és massa llarg. La longitud màxima és de %s caràcters.",
            length:         "La longitud d'aquest valor ha de ser d'entre %s i %s caràcters.",
            mincheck:       "Has de marcar un mínim de %s opcions.",
            maxcheck:       "Has de marcar un màxim de %s opcions.",
            check:          "Has de marcar entre %s i %s opcions.",
            equalto:        "Aquest valor ha de ser el mateix."
        }
    );
    // If file is loaded after Parsley main file, auto-load locale
    if ('undefined' !== typeof window.ParsleyValidator) {
        window.ParsleyValidator.addCatalog('ca', window.ParsleyConfig.i18n.ca, true);
    }
}));