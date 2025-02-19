$(window).on("load", inicio);

function inicio() {
    $("#desplegable").accordion({
        collapsible: true,
        active: false,
        animate: { 'easing': 'easeInOutExpo', 'duration': 1000 },
        disabled: false,
        heightStyle: "content",
        icons: { header: "ui-icon-plus", activeHeader: "ui-icon-minus" }
        
    });
}