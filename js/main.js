(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    // Fixed Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('shadow-sm').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('shadow-sm').css('top', '-200px');
        }
    });
    
    
   // Back to top button
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Latest-news-carousel
    $(".latest-news-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });


    // What's New carousel
    $(".whats-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:2
            }
        }
    });



    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })
    });



})(jQuery);


window.onload = async function () {
    try {
        // Step 1: Get User Location
        let locationResponse = await fetch("https://ipinfo.io/json");
        let locationData = await locationResponse.json();
        let city = locationData.city || "Unknown";
        let country = locationData.country || "";

        // Step 2: Get Weather Data
        let weatherResponse = await fetch(`https://wttr.in/${city}?format=j1`);
        let weatherData = await weatherResponse.json();
        let temperature = weatherData.current_condition[0].temp_C + "°C";
        let weatherDesc = weatherData.current_condition[0].weatherDesc[0].value;

        // Step 3: Weather Icons
        let weatherIcons = {
            "Clear": '<i class="fas fa-sun text-warning"></i>',
            "Partly cloudy": '<i class="fas fa-cloud-sun text-primary"></i>',
            "Cloudy": '<i class="fas fa-cloud text-secondary"></i>',
            "Rain": '<i class="fas fa-cloud-showers-heavy text-info"></i>',
            "Thunderstorm": '<i class="fas fa-bolt text-danger"></i>'
        };
        let weatherIcon = weatherIcons[weatherDesc] || '<i class="fas fa-question-circle text-muted"></i>'; // Default Icon

        // Step 4: Get Current Date
        let today = new Date();
        let formattedDate = today.toLocaleDateString("en-US", { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });

        // Step 5: Update HTML
        document.getElementById("temperature").textContent = temperature;
        document.getElementById("city-name").textContent = `${city}, ${country}`;
        document.getElementById("date-time").textContent = formattedDate;
        document.getElementById("weather-icon").innerHTML = weatherIcon; // Use innerHTML for FontAwesome
    } catch (error) {
        console.error("Error fetching weather data:", error);
        document.getElementById("city-name").textContent = "Weather Unavailable";
        document.getElementById("weather-icon").innerHTML = '<i class="fas fa-exclamation-circle text-danger"></i>'; // Error Icon
    }
};

