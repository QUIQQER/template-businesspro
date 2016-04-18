window.addEvent("domready", function () {
    "use strict";

    document.getElements('a img').each(function(Elm) {
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

        /*
         * Mobile nav:
         * open or close the sub nav
         */
        var Nav = document.id("navigation");
        var NavButton = document.getElement("nav.nav-box");
        var NavButtonDropDown = document.getElements(".fa-chevron-down");

        NavButtonDropDown.addEvent("click", function () {
            var Li = this.getParent('li');
            var NavSub = Li.getElement(".page-header-navigation-sub");

            if (NavSub.getStyle("height").toInt() < 1) {
                NavSub.addClass("nav-toggle-sub");
                this.addClass("fa-chevron-down-rotate-mobile");
            }
            else {
                NavSub.removeClass("nav-toggle-sub");
                this.removeClass("fa-chevron-down-rotate-mobile");
            }
        });

        NavButton.addEvent("click", function () {
            if (Nav.getStyle("height").toInt() < 1) {
                Nav.addClass("nav-toggle");
            }
            else {
                Nav.removeClass("nav-toggle");
            }

        });

    });

});
