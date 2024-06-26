window.addEvent("domready", function () {
    "use strict";

    document.getElements('[href=#top]').addEvent('click', function (event) {
        event.stop();
        new Fx.Scroll(window).toTop();
    });

    require(['qui/QUI', 'utils/Controls'], function (QUI, Controls) {
        QUI.addEvent("onError", function (msg, url, linenumber) {
            console.error(msg);
            console.error(url);
            console.error('LineNo: ' + linenumber);
        });

        /**
         * social share buttons
         */
        if (social) {
            let SlideOutElm = document.getElement(
                '[data-qui="package/quiqqer/menu/bin/SlideOut"]'
            );

            if (!SlideOutElm) {
                SlideOutElm = document.getElement(
                    '[data-qui="package/quiqqer/menu/bin/SlideoutAdvanced"]'
                );
            }

            if (SlideOutElm) {
                Controls.getControlByElement(SlideOutElm).then(function() {
                    new Element('div', {
                        'class': 'mobile-bar-social hide-on-desktop',
                        html: socialHTML
                    }).inject(SlideOutElm);
                }).catch((err) => {
                    console.error(err);
                });
            }
        }
    });

    switch (searchType) {
        case 'inputAndIcon':
            navSearchInputAndIcon();
            break;
        case 'inputAndIconVisible':
            navSearchInputAndIconVisible();
            break;
    }


    function navSearchInputAndIcon () {
        /**
         * show the search input after clicking on the icon
         */
        if (document.getElement('.header-bar-suggestSearch') &&
            document.getElement('.header-bar-suggestSearch').getElement('.fa-search')) {

            var searchBar   = document.getElement('.header-bar-suggestSearch'),
                searchIcon  = searchBar.getElement('.fa-search'),
                searchInput = searchBar.getElement('input[type="search"]'),
                open        = false;

            searchIcon.addEvent('click', function (event) {
                event.stopPropagation();

                /* open */
                if (!open) {
                    searchInput.addEvent('click', function (e) {
                        e.stopPropagation();
                    });
                    window.addEvent('click', function () {
                        searchBar.removeClass('showSearch');
                        open = false;
                        window.removeEvents('click');
                    });

                    searchBar.addClass('showSearch');

                    (function () {
                        searchInput.focus();
                    }).delay(100);

                    open = true;
                    return;
                }

                /* close */
                searchBar.removeClass('showSearch');
                open = false;
                window.removeEvents('click');
            });
        }
    }

    function navSearchInputAndIconVisible () {
        if (document.getElement('.header-bar-suggestSearch') &&
            document.getElement('.header-bar-suggestSearch').getElement('.fa-search')) {

            var searchForm = document.getElement('.header-bar-suggestSearch-inputAndIconVisible'),
                searchIcon = searchForm.getElement('.fa-search');

            searchIcon.addEvent('click', function () {
                searchForm.submit();
            });
        }
    }
});
