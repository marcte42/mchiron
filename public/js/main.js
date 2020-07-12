(function($) {

    "use strict";

    var Owlfolio = {

        // Bootstrap Carousels

        carousel: function() {

            $('.carousel.slide').carousel({
                cycle: true
            });
        },

        // Elements Equal Heights

        matchHeight: function() {
            $('.grid-3column-01 .item, full-width .item, .client-logos a').matchHeight({
                property: 'min-height'
            });

        },

        // Fancybox For Popup Image

        fancybox: function() {
            $(".fancybox").fancybox();
        },

        // Fancybox For Popup Image

        ticker: function() {
            $(".about-top").ticker({
                cursorList: " ",
                rate: 100,
                delay: 9000
            }).trigger("play").trigger("stop");
        },

        // Isotop Filters

        isotope: function() {
            var $PortfolioItems = $('.grid-3column-01, .masonry-2column-01, .masonry-4column-01, .masonry-3column-01, .full-width');
            $PortfolioItems.isotope({
                itemSelector: '.item',
                layoutMode: 'masonry',
                transitionDuration: '0.6s',
                percentPosition: true,
                margin: 45,
                masonry: {
                    columnWidth: '.item'
                }
            });

            $('.filter a').on('click', function() {
                $('.filter .active').removeClass('active');
                $(this).addClass('active');
                var selector = $(this).attr('data-filter');
                $PortfolioItems.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 600,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });
        },

        // Images Loaded

        imagesloaded: function() {
            var $PortfolioItems = $('.grid-3column-01, .masonry-2column-01, .masonry-4column-01, .masonry-3column-01, .full-width');
            $PortfolioItems.imagesLoaded().progress(function() {
                $PortfolioItems.isotope('layout');
            });
        },

        // Google Map Functions

        googlemap: function() {
            function isMobile() {
                return ('ontouchstart' in document.documentElement);
            }

            function init_gmap() {
                if (typeof google == 'undefined') return;
                var options = {
                    center: {
                        lat: -37.834812,
                        lng: 144.963055
                    },
                    zoom: 15,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                    },
                    navigationControl: true,
                    scrollwheel: false,
                    streetViewControl: true,
                    styles: [{
                        "featureType": "administrative",
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#faf8f8"
                        }]
                    }, {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [{
                            "color": "#faf8f8"
                        }]
                    }, {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    }, {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [{
                            "saturation": -100
                        }, {
                            "lightness": 45
                        }]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "simplified"
                        }]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    }, {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    }, {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [{
                            "color": "#cdcdcd"
                        }, {
                            "visibility": "on"
                        }]
                    }]
                }
                if (isMobile()) {
                    options.draggable = false;
                }
                $('#googleMaps').gmap3({
                    map: {
                        options: options
                    },
                    //marker: {
                    //    latLng: [-37.834811, 144.963054],
                    //    // options: { icon: 'images/map-icon.png' }
                    //}
                });
            }

            init_gmap();
        },
    };

    $(document).ready(function() {
        "use strict";

        // Background Img

        $(".background-bg").css('background-image', function() {
            var bg = ('url(' + $(this).data("image-src") + ')');
            return bg;
        });

        Owlfolio.carousel();
        Owlfolio.matchHeight();
        Owlfolio.isotope();
        Owlfolio.imagesloaded();
        Owlfolio.fancybox();
        Owlfolio.ticker();
        Owlfolio.googlemap();
    });

    // Overlay Menu Open / Close

    $('.menu-trigger .trigger-icon').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $('body').toggleClass('open');
    });

    $('.popup-menu .trigger-icon').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $('body').removeClass('open');
    });

    // Submenu Open Normally

    $('.popup-menu .menu-item-has-children>a, .sidebar-menu .menu-item-has-children>a').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
    });

    // Single Post Share Links

    $('.btn-container a.btn.share').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
    });

    // Responsive Menu Open and Close in Mobile

    if ($(window).width() < 767) {
        "use strict";
        $('.default-header .menu-item-has-children>a').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).parent().siblings().removeClass('open');
            $(this).parent().toggleClass('open');
        });
    };

})(jQuery);



/* Working Contact Form Js
-------------------------------------------------------------------*/
// Email from Validation
jQuery('#submit').on("click", function(e) {
    "use strict";
    //Stop form submission & check the validation
    e.preventDefault();

    // Variable declaration
    var error = false;
    var k_name = jQuery('#name').val();
    var k_email = jQuery('#email').val();
    var k_email = jQuery('#subject').val();
    var k_message = jQuery('#message').val();

    /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
    jQuery.post("email.php", jQuery(".wpcf7-form").serialize(), function(result) {
        //Check the result set from email.php file.
        if (result == 'sent') {
            $('.contact-message').html('<i class="fa fa-check contact-success"></i><div>Your message has been sent.</div>').fadeIn();
        } else {
            // $('.error-message').html('<i class="fa fa-thumbs-down contact-error"></i><div>Your message has not been sent</div>').fadeIn();
        }
    });

});