window.addEvent("domready", function () {
    "use strict";

    document.getElements('a img').each(function (Elm) {
        Elm.getParent('a').addClass('image-link');
    });

    require(['Locale'].append(QUIQQER_LOCALE), function (QUILocale) {
        QUILocale.setCurrent(QUIQQER_PROJECT.lang);

        // Load QUI
        require(["qui/QUI"], function (QUI) {
            QUI.addEvent("onError", function (msg, url, linenumber) {
                console.error(msg);
                console.error(url);
                console.error("LineNo: " + linenumber);
            });
        });
    });

});
