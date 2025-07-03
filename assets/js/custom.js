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
    
(function ($) {
    $(document).ready(function () {
        function smoothScroll(target) {
            if ($(target).length) {
                $("html, body").animate(
                    {
                        scrollTop: $(target).offset().top
                    },
                    800 // Adjust speed in milliseconds
                );
            }
        }

        // Handle clicks on the first <li> inside .social-links
        $(".social-links > li:first-child > a").on("click", function (e) {
            var targetHash = this.hash;
            var targetPath = this.pathname;

            // If the link is on the same page
            if (targetPath === window.location.pathname) {
                e.preventDefault();
                smoothScroll(targetHash);
            }
        });

        // If arriving on a page with a hash, scroll smoothly to it
        if (window.location.hash) {
            setTimeout(function () {
                smoothScroll(window.location.hash);
            }); // Small delay to ensure content loads
        }
    });
})(jQuery);

    
    
    $(".zoomable").click(function() {
        var imgSrc = $(this).attr("src");
        $("#modalImage").attr("src", imgSrc);
        $("#imageModal").fadeIn();
    });

    // Close modal when clicking on .close or outside image
    $(".close, #imageModal").click(function(e) {
        if (!$(e.target).is("#modalImage")) {
            $("#imageModal").fadeOut();
        }
    });
    
    
    
(function($) {
    function autoScrollText(selector, speed) {
        $(selector).each(function() {
            var $this = $(this);
            var scrollHeight = $this[0].scrollHeight;
            var containerHeight = $this.innerHeight();
            var isPaused = false;

            function scrollDown() {
                if (!isPaused) {
                    $this.animate({ scrollTop: scrollHeight - containerHeight }, speed, "linear", function() {
                        if (!isPaused) scrollUp();
                    });
                }
            }

            function scrollUp() {
                if (!isPaused) {
                    $this.animate({ scrollTop: 0 }, speed, "linear", function() {
                        if (!isPaused) scrollDown();
                    });
                }
            }

            // Start scrolling after a short delay
            setTimeout(scrollDown, 1000);

            // Pause on hover
            $this.hover(
                function() {
                    isPaused = true;
                    $this.stop(); // Stop animation
                },
                function() {
                    isPaused = false;
                    scrollDown(); // Resume animation
                }
            );
        });
    }

    // Apply scrolling effect
    autoScrollText(".section-goals .single-service .description", 1000);
})(jQuery);

    
(function() {

  $(".sliderHeader .owl-carousel").owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    nav: true,
    dots: false,
    navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>']
   
  });
})();

(function() {

  $(".slider-services").owlCarousel({
  items: 4,
  loop: true,
  autoplay: false,
  autoplayTimeout: 3000,
  autoplayHoverPause: false,
  nav: true,
  dots: false,
  navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
  responsive: {
      0: {
          items: 1 // 1 item on extra small screens
      },
      600: {
          items: 2 // 2 items on small screens
      },
      1000: {
          items: 3 // 3 items on medium screens
      },
      1200: {
          items: 4 // 4 items on large screens
      }
  }
  });

  })();
    
(function () {
    $(".slider-gallery").owlCarousel({
        items: 4,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        margin: 20,
        autoplayHoverPause: false,
        nav: true,
        dots: false,
        navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1 // 1 item on extra small screens
            },
            600: {
                items: 2 // 2 items on small screens
            },
            1000: {
                items: 3 // 3 items on medium screens
            },
            1200: {
                items: 4 // 4 items on large screens
            }
        }
    });

})();
    
    
  

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
    
(function() {
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
})();
    
    
    
(function() {

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
    
    (function() {
    // Toggle the dropdown menu when the button is clicked
    $('#languageDropdown').click(function(event) {
        event.stopPropagation(); // Prevent event from bubbling up
        $('.dropdown-menu').toggle(); // Toggle the visibility of the dropdown menu
    });

    // Hide the dropdown menu when a language is selected
    $('.dropdown-menu a').click(function(event) {
        event.stopPropagation(); // Prevent event from bubbling up
        $('.dropdown-menu').hide(); // Hide the dropdown menu
        var selectedLanguage = $(this).data('value'); // Get the selected language value
        setLanguage(selectedLanguage); // Update the language
        updateDropdownButton(selectedLanguage); // Update the dropdown button
    });

    // Close the dropdown menu if clicking outside of it
    $(document).click(function() {
        $('.dropdown-menu').hide();
    });
})();

    
    })();

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
            selectedImage = "assets/media/other_images/france.png";
            break;
        case 'en':
            selectedText = "English";
            selectedImage = "assets/media/other_images/united-states.png";
            break;
        case 'ar':
            selectedText = "العربية";
            selectedImage = "assets/media/other_images/morocco.png"; // You can replace this image with the appropriate one
            break;
        default:
            selectedText = "Français";
            selectedImage = "assets/media/other_images/france.png";
    }

    // Update the button text and image
    $('#languageDropdown').html('<img src="' + selectedImage + '" style="width: 20px;"> ' + selectedText);

    // Update dropdown items based on the selected language
    $('.dropdown-menu a').show(); // Reset visibility of all items
    switch(language) {
        case 'fr':
            $('.dropdown-menu a[data-value="fr"]').hide(); // Hide French option
            break;
        case 'en':
            $('.dropdown-menu a[data-value="en"]').hide(); // Hide English option
            break;
        case 'ar':
            $('.dropdown-menu a[data-value="ar"]').hide(); 
            break;
        default:
            break;
    }
}

    
// sidebar certif toggle   
(function() {    
    var triggerPoint = 300; // Set the pixel value at which the image should appear

        $(window).on('scroll', function() {
            // Check if the user has scrolled past the trigger point
            if ($(window).scrollTop() > triggerPoint) {
                $('.certifContainer').fadeIn();
            } else {
                $('.certifContainer').fadeOut();
            }
        });
    })();
    
// sidebar certif toggle end  

  
// copyright
    (function() { 
    function updateCopyrightYear() {
                var currentYear = new Date().getFullYear();
                $('#current-year').text(currentYear);
            }

            // Call the function to set the current year
            updateCopyrightYear();
    // end copyriight
    
 })();   
//map start 
    
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
//  Sticky Header
/////////////////////////////////////

(function() {
    $(document).ready(function() {

        // Only run this if the <header> element exists
        if ($('header').length) {

            var windowHeight = $(window).height();
            var windowWidth = $(window).width();

            var tabletWidth = 767;
            var mobileWidth = 640;

            if (windowWidth > tabletWidth) {
                var headerSticky = $(".layout-theme").data("header");
                var headerTop = $(".layout-theme").data("header-top");

                if (headerSticky && $('.header').length) {
                    $(window).on('scroll', function() {
                        var winH = $(window).scrollTop();
                        var $pageHeader = $('.header');

                        // Recalculate windowWidth in case of resize
                        var windowWidth = $(window).width(); 

                        if (winH > headerTop) {
                            $pageHeader.addClass("animated bounce sticky");
                            $('header').addClass("animation-done");
                        } else {
                            $pageHeader.removeClass("bounce animated sticky");
                            $('header').removeClass("animation-done");
                        }
                    });
                }
            }

            // Entrance animation only for large screens
            if (windowWidth > 1200) {
                $(window).scroll(function() {
                    $('.animatedEntrance').each(function() {
                        var imagePos = $(this).offset().top;
                        var topOfWindow = $(window).scrollTop();
                        if (imagePos < topOfWindow + 400) {
                            $(this).addClass("slideUp");
                        }
                    });
                });
            }

        }

    });
})();




/////////////////////////////////////////////////////////////////
//   Dropdown Menu Fade
/////////////////////////////////////////////////////////////////
 (function() {

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
})(); 


/////////////////////////////////////
//  Disable Mobile Animated
/////////////////////////////////////

  (function () {
    if (window.location.pathname.endsWith("index.html")) {
        var mobileWidth = 768; // Set the mobile width breakpoint
        var windowWidth = $(window).width();

        if (windowWidth < mobileWidth) {
            $("body").removeClass("animated-css");
        }

        $('.animated-css .animated:not(.animation-done)').waypoint(function () {
            var animation = $(this).data('animation');
            $(this).addClass('animation-done').addClass(animation);
        }, {
            triggerOnce: true,
            offset: '90%'
        });
    }
})();







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
(function () {
  if (window.location.hostname === "capram.ma") {
    if ($('body').length) {
      $(window).on('scroll', function () {
        var winH = $(window).scrollTop();

        $('.list-progress').waypoint(function () {
          $('.chart').each(function () {
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

        onStep: function (from, to, percent) {
          $(this.el).find('.percent').text(Math.round(percent));
        }
      });
    }
  }
})();



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

(function () {

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

})();

/////////////////////////////////////////////////////////////////
//PRICE RANGE
/////////////////////////////////////////////////////////////////
(function () {

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


});

});



/////////////////////////////////////////////////////////////////
// Animated WOW
/////////////////////////////////////////////////////////////////
new WOW().init();
