jQuery(document).ready(function($) {

    // fancy Box initialize    
    if ($('body').is('.page-template-T11-gallery,.page-template-T12-sustainability')) {
        // Initialize Fancybox if it's not the front page
        Fancybox.bind();
      }

    // Initialize Lenis
    const lenis = new Lenis();

    // Use requestAnimationFrame to continuously update the scroll
    function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
    }

    requestAnimationFrame(raf);

    $('.navbar-toggler').on('click', function() {
        $('#header').toggleClass('open');
        $('#scroll-toggler').toggleClass('open');
        $('#header-toggler').toggleClass('open');
        $('#scroll-in-toggler').toggleClass('open');
    });

    $('.search-btn').on('click', function() {
        $('#header').toggleClass('openmenu');
    });

    $('.menu-toggle-button-mobile').on('click', function() {
        $(this).toggleClass('openmenu');
        $('#header').toggleClass('opensearch');
    });

    $('.offcanvas').on('hidden.bs.offcanvas', function () {
        $('#header').removeClass('open');
        $('#scroll-toggler').removeClass('open');
        $('#header-toggler').removeClass('open');
        $('#scroll-in-toggler').removeClass('open');
    });

    //scroll to top button
    $("#scrolltotop").click(function() {
        $("html, body").animate({ scrollTop: 0 }, 600);
    });




    $(window).scroll(function() {
        var currentScrollTop = $(this).scrollTop();

        if (currentScrollTop > 100) {
            $('#header').addClass('header-scrolled');
            $('.fixedHeaderMenu').addClass('header-scrolled');
        } else {
            $('#header').removeClass('header-scrolled');
            $('.fixedHeaderMenu').removeClass('header-scrolled');
        }

        //lastScrollTop = currentScrollTop;
    });


    jQuery('.exploreBtn,ul#myTab').wrapAll('<div class="wrapperTbsUl"></div>');


    var a = 0;
    $(window).scroll(function () {
        var nav = $('.counter-box'); // Use class instead of ID
        if (nav.length) {
            var oTop = $(".counter-box").offset().top - window.innerHeight;
    
            if (a == 0 && $(window).scrollTop() > oTop) {
                $(".counter").each(function () {
                    var $this = $(this),
                        countTo = $this.attr("data-number");
                    $({
                        countNum: $this.text()
                    }).animate(
                        {
                            countNum: countTo
                        },
                        {
                            duration: 850,
                            easing: "swing",
                            step: function () {
                                $this.text(
                                    Math.ceil(this.countNum).toLocaleString("en")
                                );
                            },
                            complete: function () {
                                $this.text(
                                    Math.ceil(this.countNum).toLocaleString("en")
                                );
                            }
                        }
                    );
                });
                a = 1;
            }
        }
    });

});



document.addEventListener("DOMContentLoaded", function () {
    var lazyImages = [].slice.call(document.querySelectorAll("img.lazyImg"));

    if ("IntersectionObserver" in window) {
        var rootMarginValue = window.innerWidth < 1025 ? "100px" : "500px"; // Adjust margin based on screen width

        var lazyImageObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visibleImg");
                    var lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.imgsrc;
                    lazyImage.classList.remove("lazyImg");
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        }, {
            rootMargin: rootMarginValue,
            threshold: 0.05
        });

        lazyImages.forEach(function (lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    } else {
        // Fallback for browsers that do not support IntersectionObserver
        $.each($("img.lazyImg"), function (n, i) {
            var t = $(this).data("data-imgsrc");
            $(this).attr("src", t);
        });
    }
});
  
  //lazy load when use background images
  document.addEventListener("DOMContentLoaded", function() {
    var lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazyBackground"));
  
    if ("IntersectionObserver" in window) {

        var rootMarginValue = window.innerWidth < 1025 ? "100px" : "500px"; // Adjust margin based on screen width
        var lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                // console.log("entry background", entry);
                if (entry.isIntersecting) {
                    entry.target.classList.add("visibleImg");
                    var lazyImage = entry.target;
                    var imgUrl = lazyImage.dataset.imgsrc;
                    lazyImage.classList.remove("lazyBackground");
                    lazyBackgroundObserver.unobserve(lazyImage);
                    entry.target.style.backgroundImage = "url(" + imgUrl + ")";
  
                }
            });
        }, {
            rootMargin: rootMarginValue,
            threshold: 0.05
        });
  
        lazyBackgrounds.forEach(function(lazyBackground) {
            lazyBackgroundObserver.observe(lazyBackground);
        });
    } else {
        // fallback
        $.each($(".lazy-background"), function(n, i) {
            var bgurl = $(this).data('data-imgsrc');
            $(this).css('background-image', 'url(' + bgurl + ')');
        });
    }
  });


  document.addEventListener("DOMContentLoaded", function () {
    var lazyVideos = [].slice.call(document.querySelectorAll("video.lazyVideo"));

    if ("IntersectionObserver" in window) {
        var rootMarginValue = window.innerWidth < 1025 ? "100px" : "500px"; // Adjust margin based on screen width
        var lazyVideoObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                // console.log("entry lazyVideo", entry);
                if (entry.isIntersecting) {
                    var lazyVideo = entry.target;

                    // Load video sources
                    lazyVideo.querySelectorAll("source").forEach(function (source) {
                        source.src = source.dataset.src;
                    });

                    // Load the video and start playback (optional)
                    lazyVideo.load();
                    lazyVideo.classList.add("visibleVideo");
                    lazyVideo.classList.remove("lazyVideo");

                    lazyVideoObserver.unobserve(lazyVideo);
                }
            });
        }, {
            rootMargin: rootMarginValue,
            threshold: 0.05,
        });

        lazyVideos.forEach(function (lazyVideo) {
            lazyVideoObserver.observe(lazyVideo);
        });
    } else {
        // Fallback for older browsers
        $.each($("video.lazyVideo"), function (n, video) {
            var $video = $(video);
            $video.find("source").each(function () {
                $(this).attr("src", $(this).data("src"));
            });
            video.load();
            $video.addClass("visibleVideo").removeClass("lazyVideo");
        });
    }
});


const scrollElements = document.querySelectorAll(".js-scroll");

const elementInView = (el, dividend) => {
  const elementTop = el.getBoundingClientRect().top;
  return elementTop <= (window.innerHeight || document.documentElement.clientHeight) / dividend;
};

const elementOutofView = (el) => {
  const elementTop = el.getBoundingClientRect().top;
  return elementTop > (window.innerHeight || document.documentElement.clientHeight);
};

const displayScrollElement = (element) => {
  element.classList.add("scrolled");
};

const hideScrollElement = (element) => {
  element.classList.remove("scrolled");
};

const handleScrollAnimation = () => {
  const isLargeScreen = window.innerWidth > 1025; // Check if screen width is above 1025px
  const viewFactor = isLargeScreen ? 1.2 : 1; // Set different values for different screen sizes

  scrollElements.forEach((el) => {
    if (elementInView(el, viewFactor)) {
      displayScrollElement(el);
    } else if (elementOutofView(el)) {
      //hideScrollElement(el)
    }
  });
};

window.addEventListener("DOMContentLoaded", handleScrollAnimation);
window.addEventListener("scroll", handleScrollAnimation);



//slick slider
jQuery('.two-item-slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: true,
    dots:false,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
            breakpoint: 1025,
            settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            }
        },
        {
            breakpoint: 667,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            }
        }
    ]
});

//slick slider
jQuery('.three-item-slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    dots:false,
    infinite: true,
    // autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
            breakpoint: 1025,
            settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            }
        },
        {
            breakpoint: 667,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            }
        }
    ]
});

//slick slider
jQuery('.inner-gallery').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots:false,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000
});

//slick slider
jQuery('.slider-awards').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: false,
    dots:false,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
            breakpoint: 1025,
            settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
            }
        },
        {
            breakpoint: 667,
            settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: true,
            }
        }
    ]
});

jQuery('.slider-expo-gallery-hm').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: false,
    dots:false,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
            breakpoint: 1025,
            settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: true,
            }
        },
        {
            breakpoint: 667,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            }
        }
    ]
});

jQuery('.slider-location').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    infinite: true,       // Can keep this true with fade
    autoplay: false,
    autoplaySpeed: 3000,
    fade: true,           // Enable fade animation
    cssEase: 'linear'     // Optional: can also be 'ease', 'ease-in-out', etc.
});


jQuery('.slider-sustanable-gallery').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: true,
    dots:false,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
            breakpoint: 1025,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            }
        },
        {
            breakpoint: 600,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            }
        }
    ]
});

jQuery('.slider-awards-press').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: true,
    dots:false,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
            breakpoint: 1025,
            settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            }
        },
        {
            breakpoint: 600,
            settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            }
        }
    ]
});


