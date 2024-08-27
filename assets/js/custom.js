/*
| ----------------------------------------------------------------------------------
| TABLE OF CONTENT
| ----------------------------------------------------------------------------------
-SETTING
-Sticky Header
-Dropdown Menu Fade
-Animated Entrances
-Accordion
-Filter accordion
-Chars Start
-Сustomization select
-Zoom Images
-HOME SLIDER
-CAROUSEL PRODUCTS
-PRICE RANGE
-SLIDERS
-Animated WOW
*/





$(document).ready(function() {
    

function openTab(evt, tabName) {
    // Hide all elements with class="tabcontent" by default
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove the class "active" from all tab links
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";

    // Update the URL hash without page jump
    history.replaceState(null, null, '#' + tabName);
}

// Check if a tab is specified in the URL hash on page load
window.onload = function() {
    var hash = window.location.hash.substring(1); // Remove the # symbol
    if (hash) {
        var tabLink = document.getElementById(hash + 'Tab');
        if (tabLink) {
            tabLink.click(); // Simulate click on the corresponding tab
        }
    }
};

    
    

   // Initialize language setting on page load
var language = localStorage.getItem("lang") || "fr"; // Default to French if no language is available
setLanguage(language);
updateDropdownButton(language);

// Handle language change event
$(".dropdown-item").on("click", function(event) {
    event.preventDefault();
    var selectedLanguage = $(this).data("value");

    // Show the loading line
    $('body').append('<div id="loading-line"></div>');

    // Incrementally animate the loading line
    $('#loading-line').animate({ width: '20%' }, 200, function() {
        $('#loading-line').animate({ width: '47%' }, 200, function() {
            $('#loading-line').animate({ width: '67%' }, 200, function() {
                $('#loading-line').animate({ width: '85%' }, 200, function() {
                    $('#loading-line').animate({ width: '100%' }, 200, function() {
                        // Change language logic
                        setLanguage(selectedLanguage);
                        localStorage.setItem("lang", selectedLanguage);
                        updateDropdownButton(selectedLanguage);
                        
                        // Remove the loading line
                        $('#loading-line').remove();
                    });
                });
            });
        });
    });
});

function setLanguage(language) {
    // Check if the language is available in translations
    if (translations[language]) {
        // Update text content for elements with data-i18n attribute
        $("[data-i18n]").each(function() {
            var $element = $(this);
            var key = $element.data("i18n");
            var text = translations[language][key] || $element.text(); // Default to current text if key not found
            $element.text(text);
        });

           // Update placeholders for elements with data-placeholder-i18n attribute
        $("[data-i18n]").each(function() {
            var $element = $(this);
            var key = $element.data("i18n");
            var placeholderText = translations[language][key] || $element.attr("placeholder"); // Default to current placeholder if key not found
            $element.attr("placeholder", placeholderText);
        });
        
        
        // Toggle language-specific stylesheets (optional, depending on your use case)
        if (language === "en") {
            $("#english-stylesheet").prop("disabled", false); // Enable English-specific styles
            $("#arabic-stylesheet").prop("disabled", true);   // Disable Arabic-specific styles
        } else if (language === "ar") {
            $("#english-stylesheet").prop("disabled", true);  // Disable English-specific styles
            $("#arabic-stylesheet").prop("disabled", false);  // Enable Arabic-specific styles
        } else {
            $("#english-stylesheet").prop("disabled", true);  // Disable English-specific styles
            $("#arabic-stylesheet").prop("disabled", true);   // Disable Arabic-specific styles
        }
    } else {
        console.error("Language not found:", language);
    }
}

function updateDropdownButton(language) {
    // Update the dropdown button with the selected language
    var selectedText;
    var selectedImage;

    // Determine the dropdown button text and image based on the selected language
    switch(language) {
        case 'fr':
            selectedText = "Français";
            selectedImage = "../capram/assets/img/france.png";
            break;
        case 'en':
            selectedText = "English";
            selectedImage = "../capram/assets/img/united-states.png";
            break;
        default:
            selectedText = "Français";
            selectedImage = "../capram/assets/img/france.png";
    }

    $('#languageDropdown').html('<img src="' + selectedImage + '" style="width: 20px;"> ' + selectedText);

    // Update dropdown items based on the selected language
    if (language === 'fr') {
        $('.dropdown-menu a[data-value="fr"]').hide();
        $('.dropdown-menu a[data-value="en"]').show();
    } else if (language === 'en') {
        $('.dropdown-menu a[data-value="fr"]').show();
        $('.dropdown-menu a[data-value="en"]').hide();
    }
}


    
    
    
    
    var triggerPoint = 300; // Set the pixel value at which the image should appear

        $(window).on('scroll', function() {
            // Check if the user has scrolled past the trigger point
            if ($(window).scrollTop() > triggerPoint) {
                $('.fixed-image').fadeIn();
            } else {
                $('.fixed-image').fadeOut();
            }
        });
    
    

   var isVisible = false;

  function toggleFixedImage() {
    if (isVisible) {
      // Slide the fixed-image out and reverse arrows
      $('.fixed-image').animate({ left: '-37%' }, 500);
      $('.arrow-container').addClass('arrow-reverse');
    } else {
      // Slide the fixed-image in and reverse arrows
      $('.fixed-image').animate({ left: '0%' }, 500);
      $('.arrow-container').removeClass('arrow-reverse');
    }

    isVisible = !isVisible; // Toggle visibility state
  }

  $('#btnOpener').click(function() {
    toggleFixedImage(); // Call the function to toggle visibility and arrows
  });
    
  
    
 $('#btnOpener').click(function() {
        var $fixedImage = $('.fixed-image');
        var $arrowContainer = $('.arrow-container');
     
        
        if ($fixedImage.hasClass('hide-left')) {
            $fixedImage.removeClass('hide-left').addClass('animate__slideInLeft').addClass('show-right');
            $arrowContainer.removeClass('arrow-reverse');

        } else {
            $fixedImage.addClass('hide-left').addClass('animate__slideInRight').removeClass('show-right');
            $arrowContainer.addClass('arrow-reverse');
        }
    }); 
    
    function updateCopyrightYear() {
                var currentYear = new Date().getFullYear();
                $('#current-year').text(currentYear);
            }

            // Call the function to set the current year
            updateCopyrightYear();
    
    
    // end copyriight
    
    
function initializeMaps() {
    // Check if the map elements exist on the page
    if (document.getElementById('map1') && document.getElementById('map2')) {
        
        // Initialize the maps
        var map1 = L.map('map1', { scrollWheelZoom: false });
        var map2 = L.map('map2', { scrollWheelZoom: false });

        // Define the company's locations
        var companyLocation1 = [33.58923365298105, -7.6077161783448535];
        var companyLocation2 = [33.58609299340052, -7.602708825402712];

        // Add OpenStreetMap tiles to both maps
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map1);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map2);

        // Set the default view for each map
        map1.setView(companyLocation1, 17);
        map2.setView(companyLocation2, 17);

        // Enable scroll wheel zoom on map when the user clicks or focuses on it
        map1.on('click', function() { map1.scrollWheelZoom.enable(); });
        map2.on('click', function() { map2.scrollWheelZoom.enable(); });

        // Optionally, disable scroll wheel zoom when the user moves the mouse away from the map
        map1.on('mouseout', function() { map1.scrollWheelZoom.disable(); });
        map2.on('mouseout', function() { map2.scrollWheelZoom.disable(); });

        // Bind the button clicks to locate the company's locations
        $('#locateLocation1').click(function() {
            locateCompany(map1, companyLocation1, 'CAPRAM');
        });

        $('#locateLocation2').click(function() {
            locateCompany(map2, companyLocation2, 'COMPTOIR CAPRAM');
        });
    }
}

// Function to locate a company location with zoom-in animation
function locateCompany(map, location, name) {
    console.log("Animating map to:", location);

    // Use flyTo for smooth animation and zoom-in
    map.flyTo(location, 18, {
        animate: true,
        duration: 1.5,
        easeLinearity: 0.5
    });

    // Add or update marker for the company location with larger popup text
    L.marker(location).addTo(map)
        .bindPopup('<div class="popup-content">' + name + '</div>')
        .openPopup();
}

// Call the initializeMaps function on document ready
$(document).ready(function() {
    initializeMaps();
});

    
    /*** map end**/

    /////////////////////////////////////
    //  CUSTOM
    ///////////////////////////////////// 

$(window).scroll(function() {
    var scrollPosition = $(this).scrollTop();
    var windowWidth = $(window).width(); // Get the current window width
    var scrollThreshold = 80; // Adjust this value if needed

    if (windowWidth > 992) { // For screens larger than 992px
        if (scrollPosition > scrollThreshold) {
            $('.yamm .nav > li:last-child').css('margin-top', '-14px');
            $('.yamm .nav > li:nth-child(6)').css('margin-top', '-14px');
        } else {
            $('.yamm .nav > li:last-child').css('margin-top', '0px');
            $('.yamm .nav > li:nth-child(6)').css('margin-top', '0px');
        }
    } else { // For screens 992px or smaller
        if (scrollPosition > scrollThreshold) {
            $('.yamm .nav > li:last-child').css('margin-top', '23px');
            $('.yamm .nav > li:nth-child(6)').css('margin-top', '23px');
            $('img.logo__img.img-responsive').css('margin-top', '18px');
        } else {
            $('.yamm .nav > li:last-child').css('margin-top', '8px');
            $('.yamm .nav > li:nth-child(6)').css('margin-top', '8px');
            $('img.logo__img.img-responsive').css('margin-top', '0px');
        }
    }
});

// Trigger the function on page load to ensure the correct styles are applied
$(window).trigger('scroll');


// Trigger the function on page load to ensure the correct styles are applied
$(window).trigger('scroll');





/////////////////////////////////////////////////////////////////
// SETTING
/////////////////////////////////////////////////////////////////

    var windowHeight = $(window).height();
    var windowWidth = $(window).width();


    var tabletWidth = 767;
    var mobileWidth = 640;
	
	
	////////////////////////////////////////////  
    //  Animate the scroll to top
    ///////////////////////////////////////////  



  
  
$(function() {
  $('.scroll[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});




  
  





/////////////////////////////////////
//  Sticky Header
/////////////////////////////////////


    if (windowWidth > tabletWidth) {

        var headerSticky = $(".layout-theme").data("header");
        var headerTop = $(".layout-theme").data("header-top");

        if (headerSticky.length) {
            $(window).on('scroll', function() {
                var winH = $(window).scrollTop();
                var $pageHeader = $('.header');
                if (winH > headerTop) {

                    $('.header').addClass("animated");
                    $('header').addClass("animation-done");
                    $('.header').addClass("bounce");
                    $pageHeader.addClass('sticky');

                } else {

                    $('.header').removeClass("bounce");
                    $('.header').removeClass("animated");
                    $('.header').removeClass("animation-done");
                    $pageHeader.removeClass('sticky');
                }
            });
        }
    }


 /////////////////////////////////////
    //  HOME PAGE SLIDER
    /////////////////////////////////////
	
	var sliderpro1 = $('#sliderpro1') ;


    if (sliderpro1.length > 0) {

        sliderpro1.sliderPro({
            width: 2000,
            height: 900,
            fade: true,
            arrows: true,
            buttons: false,
            waitForLayers: false,
            thumbnailPointer: false,
            touchSwipe: false,
            autoplay: true,
            autoScaleLayers: true

        });

    }

/////////////////////////////////////////////////////////////////
//   Dropdown Menu Fade
/////////////////////////////////////////////////////////////////


    $(".dropdown").hover(
        function() {
            $('.dropdown-menu', this).stop(true, true).slideDown("fast");
            $(this).toggleClass('open');
        },
        function() {
            $('.dropdown-menu', this).stop(true, true).slideUp("fast");
            $(this).toggleClass('open');
        }
    );


    $(".yamm .navbar-nav>li").hover(
        function() {
            $('.dropdown-menu', this).fadeIn("fast");
        },
        function() {
            $('.dropdown-menu', this).fadeOut("fast");
        });


    window.prettyPrint && prettyPrint();
    $(document).on('click', '.yamm .dropdown-menu', function(e) {
        e.stopPropagation();
    });



/////////////////////////////////////
//  Disable Mobile Animated
/////////////////////////////////////

    if (windowWidth < mobileWidth) {

        $("body").removeClass("animated-css");

    }


        $('.animated-css .animated:not(.animation-done)').waypoint(function() {

                var animation = $(this).data('animation');

                $(this).addClass('animation-done').addClass(animation);

        }, {
                        triggerOnce: true,
                        offset: '90%'
        });




//////////////////////////////
// Animated Entrances
//////////////////////////////



    if (windowWidth > 1200) {

        $(window).scroll(function() {
                $('.animatedEntrance').each(function() {
                        var imagePos = $(this).offset().top;

                        var topOfWindow = $(window).scrollTop();
                        if (imagePos < topOfWindow + 400) {
                                        $(this).addClass("slideUp"); // slideUp, slideDown, slideLeft, slideRight, slideExpandUp, expandUp, fadeIn, expandOpen, bigEntrance, hatch
                        }
                });
        });

    }




/////////////////////////////////////////////////////////////////
// Accordion
/////////////////////////////////////////////////////////////////

    $(".btn-collapse").on('click', function () {
            $(this).parents('.panel-group').children('.panel').removeClass('panel-default');
            $(this).parents('.panel').addClass('panel-default');
            if ($(this).is(".collapsed")) {
                $('.panel-title').removeClass('panel-passive');
            }
            else {$(this).next().toggleClass('panel-passive');
        };
    });




/////////////////////////////////////
//  Chars Start
/////////////////////////////////////

    if ($('body').length) {
            $(window).on('scroll', function() {
                    var winH = $(window).scrollTop();

                    $('.list-progress').waypoint(function() {
                            $('.chart').each(function() {
                                    CharsStart();
                            });
                    }, {
                            offset: '80%'
                    });
            });
    }


        function CharsStart() {
            $('.chart').easyPieChart({
                    barColor: false,
                    trackColor: false,
                    scaleColor: false,
                    scaleLength: false,
                    lineCap: false,
                    lineWidth: false,
                    size: false,
                    animate: 1500,

                    onStep: function(from, to, percent) {
                            $(this.el).find('.percent').text(Math.round(percent));
                    }
            });

        }




/////////////////////////////////////////////////////////////////
// Сustomization select
/////////////////////////////////////////////////////////////////

    $('.jelect').jelect();



/////////////////////////////////////
//  Zoom Images
/////////////////////////////////////





$(".slider-product a").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000});


    $("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000});



/////////////////////////////////////////////////////////////////
// Accordion
/////////////////////////////////////////////////////////////////

    $(".btn-collapse").on('click', function () {
            $(this).parents('.panel-group').children('.panel').removeClass('panel-default');
            $(this).parents('.panel').addClass('panel-default');
            if ($(this).is(".collapsed")) {
                $('.panel-title').removeClass('panel-passive');
            }
            else {$(this).next().toggleClass('panel-passive');
        };
    });




/////////////////////////////////////////////////////////////////
// Filter accordion
/////////////////////////////////////////////////////////////////


$('.js-filter').on('click', function() {
        $(this).prev('.wrap-filter').slideToggle('slow')});

$('.js-filter').on('click', function() {
        $(this).toggleClass('filter-up filter-down')});




////////////////////////////////////////////
// CAROUSEL PRODUCTS
///////////////////////////////////////////



    if ($('#slider-product').length > 0) {

        // The slider being synced must be initialized first
        $('#carousel-product').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 84,
            itemMargin: 8,
            asNavFor: '#slider-product'
        });

        $('#slider-product').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel-product"
        });
    }



/////////////////////////////////////////////////////////////////
//PRICE RANGE
/////////////////////////////////////////////////////////////////


    if ($('#slider-price').length > 0) {


        $("#slider-price").noUiSlider({
                        start: [ 15000, 35000 ],
                        step: 500,
                        connect: true,
                        range: {
                            'min': 0,
                            'max': 50000
                        },

                        // Full number format support.
                        format: wNumb({
                            decimals: 0,
                            prefix: '$'
                        })
                    });
    // Reading/writing + validation from an input? One line.
    $('#slider-price').Link('lower').to($('#slider-price_min'));

    // Write to a span? One line.
    $('#slider-price').Link('upper').to($('#slider-price_max'));

    }




/////////////////////////////////////////////////////////////////
// Sliders
/////////////////////////////////////////////////////////////////

    var Core = {

        initialized: false,

        initialize: function() {

                if (this.initialized) return;
                this.initialized = true;

                this.build();

        },

        build: function() {

        // Owl Carousel

            this.initOwlCarousel();
        },
        initOwlCarousel: function(options) {

                        $(".enable-owl-carousel").each(function(i) {
                            var $owl = $(this);

                           var itemsData = $owl.data('items') || 4;  // Default to 4 items if not specified
                            var navigationData = $owl.data('navigation');
                            var paginationData = $owl.data('pagination');
                            var singleItemData = $owl.data('single-item');
                            var autoPlayData = $owl.data('auto-play');
                            var transitionStyleData = $owl.data('transition-style');
                            var mainSliderData = $owl.data('main-text-animation');
                            var afterInitDelay = $owl.data('after-init-delay');
                            var stopOnHoverData = $owl.data('stop-on-hover');
                            var min480 = $owl.data('min480');
                            var min768 = $owl.data('min768');
                            var min992 = $owl.data('min992');
                            var min1200 = $owl.data('min1200');

                            $owl.owlCarousel({
                                navigation : true,
                                pagination: false,
                                singleItem : false,
                                autoPlay : autoPlayData,
                                transitionStyle : transitionStyleData,
                                stopOnHover: stopOnHoverData,
                                navigationText : ["<i></i>","<i></i>"],
                                items: itemsData,
                                slideBy: 4,  // Add this line to slide 4 items at a time
                                scrollPerPage : true,
                                slideSpeed: 1000,
                                paginationSpeed: 1000,
                                itemsCustom:[
                                                [0, 1],
                                                [465, min480],
                                                [750, min768],
                                                [975, min992],
                                                [1185, min1200]
                                ],
                                afterInit: function(elem){
                                            if(mainSliderData){
                                                    setTimeout(function(){
                                                            $('.main-slider_zoomIn').css('visibility','visible').removeClass('zoomIn').addClass('zoomIn');
                                                            $('.main-slider_fadeInLeft').css('visibility','visible').removeClass('fadeInLeft').addClass('fadeInLeft');
                                                            $('.main-slider_fadeInLeftBig').css('visibility','visible').removeClass('fadeInLeftBig').addClass('fadeInLeftBig');
                                                            $('.main-slider_fadeInRightBig').css('visibility','visible').removeClass('fadeInRightBig').addClass('fadeInRightBig');
                                                    }, afterInitDelay);
                                                }
                                },
                                beforeMove: function(elem){
                                    if(mainSliderData){
                                            $('.main-slider_zoomIn').css('visibility','hidden').removeClass('zoomIn');
                                            $('.main-slider_slideInUp').css('visibility','hidden').removeClass('slideInUp');
                                            $('.main-slider_fadeInLeft').css('visibility','hidden').removeClass('fadeInLeft');
                                            $('.main-slider_fadeInRight').css('visibility','hidden').removeClass('fadeInRight');
                                            $('.main-slider_fadeInLeftBig').css('visibility','hidden').removeClass('fadeInLeftBig');
                                            $('.main-slider_fadeInRightBig').css('visibility','hidden').removeClass('fadeInRightBig');
                                    }
                                },
                                afterMove: sliderContentAnimate,
                                afterUpdate: sliderContentAnimate,
                            });
                        });
            function sliderContentAnimate(elem){
                var $elem = elem;
                var afterMoveDelay = $elem.data('after-move-delay');
                var mainSliderData = $elem.data('main-text-animation');
                if(mainSliderData){
                                setTimeout(function(){
                                                $('.main-slider_zoomIn').css('visibility','visible').addClass('zoomIn');
                                                $('.main-slider_slideInUp').css('visibility','visible').addClass('slideInUp');
                                                $('.main-slider_fadeInLeft').css('visibility','visible').addClass('fadeInLeft');
                                                $('.main-slider_fadeInRight').css('visibility','visible').addClass('fadeInRight');
                                                $('.main-slider_fadeInLeftBig').css('visibility','visible').addClass('fadeInLeftBig');
                                                $('.main-slider_fadeInRightBig').css('visibility','visible').addClass('fadeInRightBig');
                                }, afterMoveDelay);
                }
            }
        },

    };

    Core.initialize();

});



/////////////////////////////////////////////////////////////////
// Animated WOW
/////////////////////////////////////////////////////////////////
new WOW().init();
