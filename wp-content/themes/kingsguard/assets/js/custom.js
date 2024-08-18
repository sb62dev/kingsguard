jQuery(document).ready(function () {

    AOS.init();

    // Hide the submenu on page load
    jQuery('.desktopSubMenuWrap').hide();

    // Function to show the submenu with a transition
    function showSubmenu(submenuClass) {
        jQuery('.desktopSubMenuWrap .subMenuOptions > div').hide();
        jQuery('.desktopSubMenuWrap .' + submenuClass).show();
        jQuery('.desktopSubMenuWrap').slideDown(300).addClass('show');
    }

    // Function to check for the presence of multichild_menu class and update HTML structure
    function updateSubMenuStructure(menuItem) {
        var $submenuDetails = jQuery(menuItem).find('.sub-menu').html();
        var hasMultiChild = jQuery(menuItem).hasClass('multichild_menu');
        var $detailsContainer = jQuery('.serviceSubMenuDetails, .industrySubMenuDetails');
        
        if (hasMultiChild) {
            $detailsContainer.html(`
                <div class="row no-gutters">
                    <div class="col-md-2">
                        <div class="submenuWrap simpleList">
                            ${$submenuDetails}
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="childSubmenuWrap"></div>
                    </div>
                </div>
            `);

            // Show the first child submenu by default
            var firstChild = jQuery('.submenuWrap.simpleList > li:first-child');
            if (firstChild.length) {
                var firstChildSubmenu = firstChild.find('.sub-menu').html();
                if (firstChildSubmenu) {
                    jQuery('.childSubmenuWrap').html(`
                        <ul class="child-sub-menu fade-right">
                            ${firstChildSubmenu}
                        </ul>
                    `).show();
                    restartAnimation('.childSubmenuWrap .child-sub-menu');
                }
            }

            // Add hover event for submenu items to show child submenu in childSubmenuWrap
            jQuery('.submenuWrap.simpleList > li').hover(
                function () {
                    var childSubmenu = jQuery(this).find('.sub-menu').html();
                    if (childSubmenu) {
                        jQuery('.childSubmenuWrap').html(`
                            <ul class="child-sub-menu fade-right">
                                ${childSubmenu}
                            </ul>
                        `).show();
                        restartAnimation('.childSubmenuWrap .child-sub-menu');
                    } else {
                        jQuery('.childSubmenuWrap').empty();
                    }
                },
                function () {
                    // Optional: Clear the child submenu on hover out
                    // jQuery('.childSubmenuWrap').empty();
                }
            );
        } else {
            $detailsContainer.html(`
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="submenuWrap">
                            ${$submenuDetails}
                        </div>
                    </div>
                </div>
            `);
        }
    }

    // Function to restart the animation
    function restartAnimation(selector) {
        var element = jQuery(selector);
        element.removeClass('fade-right');
        void element[0].offsetWidth; // Trigger reflow
        element.addClass('fade-right');
    }

    // Event handlers for hovering on the main menu items
    jQuery('.website_nav .menu-item-services').hover(
        function () {
            showSubmenu('serviceSubmenu');
            var firstItem = jQuery('.serviceMenu > li:first-child');
            updateSubMenuStructure(firstItem);
        },
        function () {
            // Do nothing when hovering out of the main menu item
        }
    );

    jQuery('.website_nav .menu-item-industries').hover(
        function () {
            showSubmenu('industrySubmenu');
            var firstItem = jQuery('.industryMenu > li:first-child');
            updateSubMenuStructure(firstItem);
        },
        function () {
            // Do nothing when hovering out of the main menu item
        }
    );

    jQuery('.website_nav .menu-item').not('.menu-item-services, .menu-item-industries').hover(
        function () {
            jQuery('.desktopSubMenuWrap').slideUp(300).removeClass('show');
            jQuery('.desktopSubMenuWrap .desktopSubMenuInner .subMenuWrap').removeClass('fade-right');
            jQuery('.desktopSubMenuWrap .desktopSubMenuInner .serviceSubMenuDetails').removeClass('fade-right');
            jQuery('.desktopSubMenuWrap .desktopSubMenuInner .industrySubMenuDetails').removeClass('fade-right');
        },
        function () {
        }
    );

    // Event handlers for hovering on submenu items
    jQuery('.serviceMenu > li').hover(
        function () {
            var submenuDetails = jQuery(this).find('.sub-menu').html();
            var hasMultiChild = jQuery(this).hasClass('multichild_menu');
            var $detailsContainer = jQuery('.serviceSubMenuDetails');
            
            if (hasMultiChild) {
                $detailsContainer.html(`
                    <div class="row no-gutters">
                        <div class="col-md-2">
                            <div class="submenuWrap simpleList">
                                ${submenuDetails}
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="childSubmenuWrap"></div>
                        </div>
                    </div>
                `);

                 // Show the first child submenu by default
                var firstChild = jQuery('.submenuWrap.simpleList > li:first-child');
                if (firstChild.length) {
                    var firstChildSubmenu = firstChild.find('.sub-menu').html();
                    if (firstChildSubmenu) {
                        jQuery('.childSubmenuWrap').html(`
                            <ul class="child-sub-menu fade-right">
                                ${firstChildSubmenu}
                            </ul>
                        `).show();
                        restartAnimation('.childSubmenuWrap .child-sub-menu');
                    }
                }

                // Add hover event for submenu items to show child submenu in childSubmenuWrap
                jQuery('.submenuWrap.simpleList > li').hover(
                    function () {
                        var childSubmenu = jQuery(this).find('.sub-menu').html();
                        if (childSubmenu) {
                            jQuery('.childSubmenuWrap').html(`
                                <ul class="child-sub-menu fade-right">
                                    ${childSubmenu}
                                </ul>
                            `).show();
                            restartAnimation('.childSubmenuWrap .child-sub-menu');
                        } else {
                            jQuery('.childSubmenuWrap').empty();
                        }
                    },
                    function () {
                        // Optional: Clear the child submenu on hover out
                        // jQuery('.childSubmenuWrap').empty();
                    }
                );
            } else {
                $detailsContainer.html(`
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="submenuWrap">
                                ${submenuDetails}
                            </div>
                        </div>
                    </div>
                `);
            }
            restartAnimation('.serviceSubMenuDetails');
        },
        function () {
            // Do nothing when not hovering over a menu item
        }
    );

    jQuery('.industryMenu > li').hover(
        function () {
            var submenuDetails = jQuery(this).find('.sub-menu').html();
            var hasMultiChild = jQuery(this).hasClass('multichild_menu');
            var $detailsContainer = jQuery('.industrySubMenuDetails');
            
            if (hasMultiChild) {
                $detailsContainer.html(`
                    <div class="row no-gutters">
                        <div class="col-md-2">
                            <div class="submenuWrap simpleList">
                                ${submenuDetails}
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="childSubmenuWrap"></div>
                        </div>
                    </div>
                `);

                 // Show the first child submenu by default
                var firstChild = jQuery('.submenuWrap.simpleList > li:first-child');
                if (firstChild.length) {
                    var firstChildSubmenu = firstChild.find('.sub-menu').html();
                    if (firstChildSubmenu) {
                        jQuery('.childSubmenuWrap').html(`
                            <ul class="child-sub-menu fade-right">
                                ${firstChildSubmenu}
                            </ul>
                        `).show();
                        restartAnimation('.childSubmenuWrap .child-sub-menu');
                    }
                }

                // Add hover event for submenu items to show child submenu in childSubmenuWrap
                jQuery('.submenuWrap.simpleList > li').hover(
                    function () {
                        var childSubmenu = jQuery(this).find('.sub-menu').html();
                        if (childSubmenu) {
                            jQuery('.childSubmenuWrap').html(`
                                <ul class="child-sub-menu fade-right">
                                    ${childSubmenu}
                                </ul>
                            `).show();
                            restartAnimation('.childSubmenuWrap .child-sub-menu');
                        } else {
                            jQuery('.childSubmenuWrap').empty();
                        }
                    },
                    function () {
                        // Optional: Clear the child submenu on hover out
                        // jQuery('.childSubmenuWrap').empty();
                    }
                );
            } else {
                $detailsContainer.html(`
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="submenuWrap">
                                ${submenuDetails}
                            </div>
                        </div>
                    </div>
                `);
            }
            restartAnimation('.industrySubMenuDetails');
        },
        function () {
            // Do nothing when not hovering over a menu item
        }
    );

    // Ensure the submenu remains visible when hovering over the submenu wrap
    jQuery('.desktopSubMenuWrap').hover(
        function () {
            // Do nothing when hovering over the submenu
        },
        function () {
            jQuery('.desktopSubMenuWrap').slideUp(300).removeClass('show');
            jQuery('.desktopSubMenuWrap .desktopSubMenuInner .subMenuWrap').removeClass('fade-right');
            jQuery('.desktopSubMenuWrap .desktopSubMenuInner .serviceSubMenuDetails').removeClass('fade-right');
            jQuery('.desktopSubMenuWrap .desktopSubMenuInner .industrySubMenuDetails').removeClass('fade-right');
        }
    );

    jQuery('.homeBannerSlider').slick({
        infinite: true,
        arrows: false,
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        speed: 300,
        autoplaySpeed: 3000,
        pauseOnHover: false,
    }); 

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
        speed: 2500,
        autoplaySpeed: 0,
        cssEase: 'linear',
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

    // jQuery('#exampleModal').on('shown.bs.modal', function () {
    //     // Autoplay the video when the modal is shown
    //     var videoFrame = document.getElementById('videoFrame');
    //     var videoSrc = videoFrame.src;
    //     videoFrame.src = videoSrc + '&autoplay=1';
    // });

    // jQuery('#exampleModal').on('hidden.bs.modal', function () {
    //     // Pause the video when the modal is closed
    //     var videoFrame = document.getElementById('videoFrame');
    //     videoFrame.contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
    // });

  var video = document.getElementById('background-video');
  var playButton = document.getElementById('play-button');

  if (video && playButton) {
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
  };

  var video2 = document.getElementById('background-video2');
  var playButton2 = document.getElementById('play-button2');

  if (video2 && playButton2) {
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
  };

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

  jQuery('a.smooth-scroll').on('click', function(event) {
    event.preventDefault();
    
    var target = jQuery(this).attr('href');
    var offsetTop = jQuery(target).offset().top - 120; // Subtract 120px from the target offset
    
    jQuery('html, body').animate({
        scrollTop: offsetTop
    }, 800); // 800 milliseconds
  });
  
  const citySelect = document.querySelector('select[name="city"]');
  const serviceSelect = document.querySelector('select[name="service"]');
  const loader = document.getElementById('projectLoader');

  if (citySelect && serviceSelect && loader) {
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
                  if (projectsContainer) {
                      projectsContainer.innerHTML = response.data;
                  }
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
  }

  jQuery('#jobseek_application_resume').on('change', function() {
      var fileName = jQuery(this).val().split('\\').pop();
      jQuery('#file-name').text(fileName || 'No file chosen');
  });
 
  var currentUrl = window.location.pathname;

  jQuery('.dashboardMenu a').each(function() {
      if (jQuery(this).attr('href') === currentUrl) {
        jQuery(this).addClass('active');
      }
  });

  jQuery('#projectVideo').on('show.bs.modal', function(event) {
      var button = jQuery(event.relatedTarget); // Button that triggered the modal
      var videoUrl = button.data('video'); // Extract info from data-* attributes
      var modal = jQuery(this);
      modal.find('#videoFrame').attr('src', videoUrl);
  });

  jQuery('#projectVideo').on('hidden.bs.modal', function() {
    jQuery('#videoFrame').attr('src', ''); // Remove the video source when the modal is closed
  });

  function getCookie(name) {
	var value = "; " + document.cookie;
	var parts = value.split("; " + name + "=");
	if (parts.length === 2) return parts.pop().split(";").shift();
	return null;
  }

  if (getCookie('jobseeker_logged_in') === 'true') {
		var username = getCookie('jobseeker_username');
		if (username) {
			var profileImage = '<img src="/wp-content/themes/kingsguard/assets/images/user.png" alt="Profile Icon">';
			jQuery('.jobseek_login_link').addClass('loggedIn');
			jQuery('.jobseek_login_link a').html(profileImage + ' ' + username);
		}
  } 
 
  jQuery('.homeDeskSlider video, .homeMobSlider video').each(function() {
    this.pause();
  });

}); 

function initializeSlider(selector) {
    var $slider = $(selector); 

    $slider.slick({
        dots: true,
        arrows: false,
        appendDots: $('.heroSliderDots'),
        customPaging: function(slider, i) {
            var video = $(slider.$slides[i]).find('video').get(0);
            var duration = $(video).data('duration'); // Use the data-duration attribute

            return `
            <span class="dot">
                <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="timer_circle">
                    <g>
                        <circle id="circle" class="circle_animation" r="14" cy="15" cx="15" stroke-width="2" stroke="#ffffff" fill="none" stroke-dasharray="0, 88"/>
                    </g>
                </svg>
                <span class="duration">${duration}</span>
            </span>`;
        }
    });

    let countdownInterval;

    $slider.on('afterChange', function(event, slick, currentSlide) {
        var video = $(slick.$slides[currentSlide]).find('video').get(0);
        video.play();  // Start playing the video after the slide changes

        clearInterval(countdownInterval);

        var duration = $(video).data('duration'); // Use the data-duration attribute
        var totalDuration = duration;

        updateCountdown(duration, currentSlide, totalDuration);

        countdownInterval = setInterval(function() {
            duration--;
            updateCountdown(duration, currentSlide, totalDuration);

            if (duration <= 0) {
                clearInterval(countdownInterval);
                $slider.slick('slickNext');
            }
        }, 1000);

        video.onended = function() {
            $slider.slick('slickNext');
        };
    });

    $slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        var video = $(slick.$slides[currentSlide]).find('video').get(0);
        video.pause();
        video.currentTime = 0;

        clearInterval(countdownInterval);

        $('.heroSliderDots .slick-dots li').each(function(index) {
            if (index !== nextSlide) {
                $(this).find('.circle_animation').css('stroke-dasharray', '0, 88');
                $(this).find('.duration').text('');
            }
        });
    });

function updateCountdown(duration, currentSlide, totalDuration) {
        var percentage = (1 - (duration / totalDuration)) * 88;
        var circle = $('.heroSliderDots .slick-dots li').eq(currentSlide).find('.circle_animation');
        circle.css('stroke-dasharray', `${percentage}, 88`);
        $('.heroSliderDots .slick-dots li').eq(currentSlide).find('.duration').text(duration);
    }
    $slider.slick('slickGoTo', 0);
}

function handleResponsiveSliders() {
    if ($(window).width() <= 767) {
        if (!$('.homeMobSlider').hasClass('slick-initialized')) {
            initializeSlider('.homeMobSlider');
        }
        if ($('.homeDeskSlider').hasClass('slick-initialized')) {
            $('.homeDeskSlider').slick('unslick');
        }
    } else {
        if (!$('.homeDeskSlider').hasClass('slick-initialized')) {
            initializeSlider('.homeDeskSlider');
        }
        if ($('.homeMobSlider').hasClass('slick-initialized')) {
            $('.homeMobSlider').slick('unslick');
        }
    }
}  

jQuery(window).on('load', function() { 

    handleResponsiveSliders(); 

    jQuery('.homeDeskSlider video, .homeMobSlider video').each(function() {
        this.play();
    });

}); 