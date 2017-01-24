window.addEvent("domready", function () {
    "use strict";

    document.getElements('a img').each(function (Elm) {
        Elm.getParent('a').addClass('image-link');
    });

    document.getElements('[href=#top]').addEvent('click', function (event) {
        event.stop();
        new Fx.Scroll(window).toTop();
    });
});
