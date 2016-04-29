(function ($) {
    'use strict';

    $(window).load(function () {
	
	if(document.getElementById("main-holdercon")) { 
	var height = document.getElementById("headerfix").offsetHeight;
        document.getElementById("main-holdercon").style.marginTop = height + 'px';
		}
	    $(".responsive").fitText(1.1);
        $('.hider-page').each(function () {
		$(this).fadeOut(200);
		});
    });

    $(document).ready(function () {

/*-----------------------------------------------------------------------------------*/
/*	Top Panel
/*-----------------------------------------------------------------------------------*/

	$('.top-panel-button').on("click", function(){
		$('.top-panel-content').slideToggle();
		$(this).toggleClass("active");
	});

	$('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		},
		callbacks: {
afterClose: function() {
			if (typeof niceScrolltrue !== 'undefined' && niceScrolltrue == 1) {
$('html').css('overflow', 'hidden');
}
}
}
	});
	$('.zoom-gallery').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
		delegate: 'a.zoomer',
		type: 'image',
		closeOnContentClick: false,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
			}
		},
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true,
			duration: 300, // don't foget to change the duration also in CSS
			opener: function(element) {
				return element.find('img');
			}
		},
		callbacks: {
afterClose: function() {
			if (typeof niceScrolltrue !== 'undefined' && niceScrolltrue == 1) {
$('html').css('overflow', 'hidden');
}
}
}
	});	
	});
	////instagram
		$('.zoom-instagram').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
		delegate: 'a.zoomer',
		type: 'image',
		closeOnContentClick: false,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				return item.el.attr('title') + ' by <a class="image-source-link" href="http://www.instagram.com/'+item.el.attr('data-source')+'" target="_blank">'+item.el.attr('data-source')+'</a>';
			}
		},
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true,
			duration: 300, // don't foget to change the duration also in CSS
			opener: function(element) {
				return element.find('img');
			}
		},
		callbacks: {
afterClose: function() {
			if (typeof niceScrolltrue !== 'undefined' && niceScrolltrue == 1) {
$('html').css('overflow', 'hidden');
}
}
}
	});	
	});
	$('.popup-with-zoom-anim').magnificPopup({
		type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in',
		focus: '#search',

		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#search';
				}
			},
			afterClose: function() {
			if (typeof niceScrolltrue !== 'undefined' && niceScrolltrue == 1) {
$('html').css('overflow', 'hidden');
}
}
		}
	});
        $(".flexnav").flexNav();


        //Zoom fix
        // IPad/IPhone
        var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
            ua = navigator.userAgent,

            gestureStart = function () {
                viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
            },

            scaleFix = function () {
                if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
                    viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
                    document.addEventListener("gesturestart", gestureStart, false);
                }
            };
        scaleFix();


        		$('.skills').appear(function() {
$(".chart").each(function() {
var size = $(this).attr('data-size');
var fgcolor = $(this).attr('data-fgcolor');
var bgcolor = $(this).attr('data-bgcolor');
var donutwidth = $(this).attr('data-donutwidth');
		$(this).easyPieChart({
			easing: 'easeInOutQuad',
			barColor: fgcolor,
			animate: 2000,
			trackColor: bgcolor,
			lineWidth: donutwidth,
			lineCap: 'round',
			size: size,
			scaleColor: false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
		});
});	


        $('.bars').appear(function () {
            $('.progress').each(function () {
                var percentage = $(this).find('.bar').attr('data-progress');
                $(this).find('.bar').css('width', '0%');
                $(this).find('.bar').animate({
                    width: percentage + '%'
                }, {
                    duration: 800,
                    easing: 'swing'
                });
            });
        });
		
        // ---------------------------------------------------------
        // Tooltip
        // ---------------------------------------------------------
        $("[data-rel='tooltip']").tooltip();
        // ---------------------------------------------------------
        // Back to Top
        // ---------------------------------------------------------
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });
        $('#back-top a').click(function () {
            $('body,html').stop(false, false).animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        // ---------------------------------------------------------
        // Add accordion active class
        // ---------------------------------------------------------
        $('.accordion').on('show', function (e) {
            $(e.target).prev('.accordion-heading').find('.accordion-toggle').addClass('active');

        });
        $('.accordion').on('hide', function (e) {
            $(this).find('.accordion-toggle').not($(e.target)).removeClass('active');
        });
        // ---------------------------------------------------------
        // Isotope Init
        // ---------------------------------------------------------
        $("#portfolio-grid").css({
            "visibility": "visible"
        });
        // ---------------------------------------------------------
		// placeholder fix
$('[placeholder]').focus(function() {
var input = $(this);
if (input.val() == input.attr('placeholder')) {
input.val('');
input.removeClass('placeholder');
}
}).blur(function() {
var input = $(this);
if (input.val() == '' || input.val() == input.attr('placeholder')) {
input.addClass('placeholder');
input.val(input.attr('placeholder'));
}
}).blur().parents('form').submit(function() {
$(this).find('[placeholder]').each(function() {
var input = $(this);
if (input.val() == input.attr('placeholder')) {
input.val('');
}
})
});
});
    $(function () {
        $.stellar({
            horizontalScrolling: false
        });
    });
}(jQuery));