window.addEvent("domready", function ()
{
    "use strict";

    document.getElements('[href=#top]').addEvent('click', function (event)
    {
        event.stop();
        new Fx.Scroll(window).toTop();
    });

    /**
     * show the search input after clicking on the icon
     */
    if (document.getElement('.header-bar-suggestSearch') &&
        document.getElement('.header-bar-suggestSearch').getElement('.fa-search')) {

        var searchBar   = document.getElement('.header-bar-suggestSearch'),
            searchIcon  = searchBar.getElement('.fa-search'),
            searchInput = searchBar.getElement('input[type="search"]'),
            open        = false;

        searchIcon.addEvent('click', function (event)
        {
            event.stopPropagation();

            /* open */
            if (!open) {
                searchInput.addEvent('click', function (e)
                {
                    e.stopPropagation();
                });
                window.addEvent('click', function ()
                {
                    searchBar.removeClass('showSearch');
                    open = false;
                    window.removeEvents('click');
                });

                searchBar.addClass('showSearch');
                searchInput.focus();
                open = true;
                return;
            }

            /* close */
            searchBar.removeClass('showSearch');
            open = false;
            window.removeEvents('click');
        });
    }
});

