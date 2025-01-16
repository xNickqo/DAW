$(window).on("load", inicio);

function inicio(){
    $("#desplegable").accordion({
        collapsible:true,
        active:true,
        animate:{'easing':'easeInOutExpo', 'duration':2000},
        disabled:false,
        header:"h5",
        heightStyle:"content",
        icons:"header"
    });
}