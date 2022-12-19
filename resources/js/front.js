require('./bootstrap');

// require('./mantener-relacion-alto');

// require('./abrir-html-fancy');

require('sweetalert');

require('lity');

require('./formularios');

//javascript general para el front

$(function() {
    $('.fancybox').fancybox({ padding: 0, afterShow: function() { $(window).resize(); } });
    GLightbox({selector: ".glightbox-video",closeOnOutsideClick: true,videosWidth: "90%",skin: 'glightbox-vid glightbox-clean'});

    //truquito para extender el color del último item del menú de accesos rápidos
    $('.accesos-rapidos').css('--ultimoColor', $('.accesos-rapidos .col:last-child').css('background-color'));
});