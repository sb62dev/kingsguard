jQuery(document).ready(function () {
    jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      jQuery('.slider').slick('setPosition');
    });
    
    jQuery('.testimonials').slick({
        infinite: true,
        arrows: false,
        autoplay: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        speed: 1000,
        autoplaySpeed: 3000,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
            }
          }
      ]
    });
    jQuery(".prev-btn").click(function () {
      jQuery(".testimonials").slick("slickPrev");
    });

    jQuery(".next-btn").click(function () {
      jQuery(".testimonials").slick("slickNext");
    });
    jQuery(".prev-btn").addClass("slick-disabled");
    jQuery(".testimonials").on("afterChange", function () {
          if (jQuery(".slick-prev").hasClass("slick-disabled")) {
              jQuery(".prev-btn").addClass("slick-disabled");
          } else {
              jQuery(".prev-btn").removeClass("slick-disabled");
          }
          if (jQuery(".slick-next").hasClass("slick-disabled")) {
              jQuery(".next-btn").addClass("slick-disabled");
          } else {
              jQuery(".next-btn").removeClass("slick-disabled");
          }
      });

    jQuery('.clientLogo').slick({
        infinite: true,
        arrows: false,
        autoplay: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        dots: false,
        speed: 1000,
        autoplaySpeed: 3000,
        responsive: [
            {
              breakpoint: 1441,
              settings: {
                slidesToShow: 5,
              }
            },
            {
              breakpoint: 1201,
              settings: {
                slidesToShow: 4,
              }
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 3,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              }
            }
        ]
    });

    jQuery('.partnerLogo').slick({
        infinite: true,
        arrows: false,
        autoplay: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        dots: false,
        speed: 1000,
        autoplaySpeed: 3000,
        responsive: [
            {
              breakpoint: 1441,
              settings: {
                slidesToShow: 5,
              }
            },
            {
              breakpoint: 1201,
              settings: {
                slidesToShow: 4,
              }
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 3,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              }
            }
        ]
    });

    jQuery('.associationLogo').slick({
        infinite: true,
        arrows: false,
        autoplay: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        dots: false,
        speed: 1000,
        autoplaySpeed: 3000,
        responsive: [
            {
              breakpoint: 1441,
              settings: {
                slidesToShow: 5,
              }
            },
            {
              breakpoint: 1201,
              settings: {
                slidesToShow: 4,
              }
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 3,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              }
            }
        ]
    });

    jQuery('.whyChooseSlider').slick({
        infinite: true,
        arrows: false,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        speed: 1000,
        autoplaySpeed: 3000,
    });
    jQuery(".prev-btn").click(function () {
      jQuery(".whyChooseSlider").slick("slickPrev");
    });

    jQuery(".next-btn").click(function () {
      jQuery(".whyChooseSlider").slick("slickNext");
    });
    jQuery(".prev-btn").addClass("slick-disabled");
    jQuery(".whyChooseSlider").on("afterChange", function () {
          if (jQuery(".slick-prev").hasClass("slick-disabled")) {
              jQuery(".prev-btn").addClass("slick-disabled");
          } else {
              jQuery(".prev-btn").removeClass("slick-disabled");
          }
          if (jQuery(".slick-next").hasClass("slick-disabled")) {
              jQuery(".next-btn").addClass("slick-disabled");
          } else {
              jQuery(".next-btn").removeClass("slick-disabled");
          }
      });

    jQuery(window).scroll(function () {

        var sticky = jQuery('.sticky-header'),
            scroll = jQuery(window).scrollTop();

        if (jQuery(window).width() > 992) {
            if (scroll >= 250) {
                sticky.addClass('Sticky-fixed');
            } else {
                sticky.removeClass('Sticky-fixed');
            }
        }

    });

    jQuery('.navbar-toggler').on('click', function () {
        jQuery('body').toggleClass('scrl_fixed');
    });
    
    jQuery('.closeBtn a, .fixdNav .fixdNav-mid li a').on('click', function () {
        jQuery('body').removeClass('scrl_fixed');
    });

    const navLinks = document.querySelectorAll('.fixdNav .fixdNav-mid li a')
    const menuToggle = document.getElementById('collapsibleNavbar')
    const bsCollapse = new bootstrap.Collapse(menuToggle, {
        toggle: false
    })
    navLinks.forEach((l) => {
        l.addEventListener('click', () => {
            bsCollapse.toggle()
        })
    })

    jQuery(".smoth-scroll").on('click', function (event) { 
        if (this.hash !== "") { 
            event.preventDefault(); 
            var hash = this.hash; 
            jQuery('html, body').animate({
                scrollTop: jQuery(hash).offset().top
            }, 800, function () { 
                window.location.hash = hash;
            });
        }
    });

    jQuery(window).scroll(function () {
        var windscroll = jQuery(window).scrollTop();
        if (windscroll >= 100) {
            jQuery('.cmnSec').each(function (i) {
                if (jQuery(this).position().top <= windscroll + 100) {
                    jQuery('.main-navigation li .active').removeClass('active');
                    jQuery('.main-navigation li a').eq(i).addClass('active');
                }
            });

        } else {
            jQuery('.main-navigation li .active').removeClass('active');
        }

    }).scroll();

    jQuery('#exampleModal').on('shown.bs.modal', function () {
        // Autoplay the video when the modal is shown
        var videoFrame = document.getElementById('videoFrame');
        var videoSrc = videoFrame.src;
        videoFrame.src = videoSrc + '&autoplay=1';
    });

    jQuery('#exampleModal').on('hidden.bs.modal', function () {
        // Pause the video when the modal is closed
        var videoFrame = document.getElementById('videoFrame');
        videoFrame.contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
    });

}); 

jQuery(document).ready(function () {
  var video = document.getElementById('background-video');
  var playButton = document.getElementById('play-button');

  if (video.paused || video.ended) {
      playButton.classList.remove('playing');
      playButton.classList.add('paused');
  } else {
      playButton.classList.remove('paused');
      playButton.classList.add('playing');
  }

  playButton.addEventListener('click', function () {
      if (video.paused || video.ended) {
          video.play();
          playButton.classList.remove('paused');
          playButton.classList.add('playing');
      } else {
          video.pause();
          playButton.classList.add('paused');
          playButton.classList.remove('playing');
      }
  });

  video.addEventListener('play', function () {
      playButton.classList.add('playing');
      playButton.classList.remove('paused');
  });

  video.addEventListener('pause', function () {
      playButton.classList.remove('playing');
      playButton.classList.add('paused');
  });

  video.addEventListener('ended', function () {
      playButton.classList.add('paused');
      playButton.classList.remove('playing');
  });
  
});


jQuery(document).ready(function () {
  var video2 = document.getElementById('background-video2');
  var playButton2 = document.getElementById('play-button2');

  if (video2.paused || video2.ended) {
      playButton2.classList.remove('playing2');
      playButton2.classList.add('paused2');
  } else {
      playButton2.classList.remove('paused2');
      playButton2.classList.add('playing2');
  }

  playButton2.addEventListener('click', function () {
      if (video2.paused || video2.ended) {
          video2.play();
          playButton2.classList.remove('paused2');
          playButton2.classList.add('playing2');
      } else {
          video2.pause();
          playButton2.classList.add('paused2');
          playButton2.classList.remove('playing2');
      }
  });

  video2.addEventListener('play2', function () {
      playButton2.classList.add('playing2');
      playButton2.classList.remove('paused2');
  });

  video2.addEventListener('pause2', function () {
      playButton2.classList.remove('playing2');
      playButton2.classList.add('paused2');
  });

  video2.addEventListener('ended2', function () {
      playButton2.classList.add('paused2');
      playButton2.classList.remove('playing2');
  });

});

jQuery(document).ready(function () {
  function handleSubMenuToggle() {
    if (jQuery(window).width() < 991) {
      jQuery('.sub-menu-toggle').off('click').on('click', function () {
            const submenu = jQuery(this).next('.sub-menu');
            const isExpanded = jQuery(this).attr('aria-expanded') === 'true';

            submenu.slideToggle(!isExpanded);
            jQuery(this).attr('aria-expanded', !isExpanded);
        });
    } else {
      jQuery('.sub-menu-toggle').off('click');
    }
  }

  handleSubMenuToggle();

  jQuery(window).resize(function () {
      handleSubMenuToggle();
  });
});

function smoothScrollTo(hash, offsetAdjustment = 90) {
    if (hash !== "") {
        var targetOffset = $(hash).offset().top;
        var headerHeight = $('.main_header').outerHeight() || 0;
        var offset = targetOffset - headerHeight - offsetAdjustment;
        $('html, body').animate({
            scrollTop: offset
        }, {
            duration: 1500,
            complete: function () {
                window.history.replaceState(null, null, hash);
            }
        });
    }
}
document.addEventListener('DOMContentLoaded', function () {
  const citySelect = document.querySelector('select[name="city"]');
  const serviceSelect = document.querySelector('select[name="service"]');
  const loader = document.getElementById('projectLoader');

  // Add change event listeners to both selects
  citySelect.addEventListener('change', function () {
      const selectedCity = citySelect.value === 'all' ? '' : citySelect.value;
      const selectedService = serviceSelect.value === 'all' ? '' : serviceSelect.value;

      showLoader();
      fetchFilteredProjects(selectedCity, selectedService);
  });

  serviceSelect.addEventListener('change', function () {
      const selectedCity = citySelect.value === 'all' ? '' : citySelect.value;
      const selectedService = serviceSelect.value === 'all' ? '' : serviceSelect.value;

      showLoader();
      fetchFilteredProjects(selectedCity, selectedService);
  });

  function fetchFilteredProjects(city, service) {
      const xhr = new XMLHttpRequest();
      const data = new FormData();
      data.append('action', 'filter_projects');
      data.append('city', city);
      data.append('service', service);

      xhr.open('POST', projectFilter.ajax_url, true);
      xhr.onload = function () {
          hideLoader();

          if (xhr.status === 200) {
              const response = JSON.parse(xhr.responseText);
              const projectsContainer = document.querySelector('.projects_section_two .row');
              projectsContainer.innerHTML = response.data;
          }
      };
      xhr.send(data);
  }

  function showLoader() {
      loader.style.display = 'flex';
  }

  function hideLoader() {
      loader.style.display = 'none';
  }
});
