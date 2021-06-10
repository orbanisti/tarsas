// loads the Bootstrap jQuery plugins

var $ = require('jquery/dist/jquery');
var jQuery = $;
window.$ = $;
window.jQuery = $;
import 'popper.js'
import 'bootstrap'
import '../scss/app.scss';
// loads the code syntax highlighting library
// import './highlight.js';
require('bootstrap-drawer/js/drawer')
import {CountUp} from 'countup.js';


require('jqvmap/dist/jquery.vmap');
require('jqvmap/dist/maps/jquery.vmap.europe');
require('jquery.waitforimages')
require('animate.css');
require('textillate/assets/jquery.fittext')
require('textillate/assets/jquery.lettering')
require('textillate/jquery.textillate')
import AOS from 'aos';

window.AOS = AOS
window.CountUp = CountUp;
$(document).ready(function () {
    let drawerMenu = $("#drawerMenu");
    const optionsCountUp = {
        useEasing: true,
        separator: '',
        decimal: '.'
    };

    $.fn.isInViewport = function () {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    };
    let letterAnimationPrevState = null;
    let countUpAnimationState = null;
    $('.lettersAnimation').textillate({
        in: {
            // set the effect name
            effect: 'fadeInUp',
            // set the delay factor applied to each consecutive character
            delayScale: 1.5,

            // set the delay between each character
            delay: 10,

        },
    })
    $(window).scroll(function () {
        // console.log("scroll top=" + $(this).scrollTop());
        // console.log("div offset top=" + $("div").offset().top);
        $('.lettersAnimation').each(function () {
            if ($(this).isInViewport()) {
                if (letterAnimationPrevState !== $(this).isInViewport()) {
                    letterAnimationPrevState = $(this).isInViewport();
                    $(".lettersAnimation").textillate('start');
                }
            } else {
                if (letterAnimationPrevState !== $(this).isInViewport()) {
                    letterAnimationPrevState = $(this).isInViewport();
                    $(".lettersAnimation").textillate('stop');
                }
            }
        })
        $('.countup-numbers').each(function () {
            if ($(this).isInViewport()) {
                if (countUpAnimationState !== $(this).isInViewport()) {
                    countUpAnimationState = $(this).isInViewport();
                    countUp()
                }
            } else {
                if (countUpAnimationState !== $(this).isInViewport()) {
                    countUpAnimationState = $(this).isInViewport();
                    countUp()
                }
            }
        })
    })

    function countUp() {
        $('.countup-numbers').each(function (index, element) {
            let num = $(this).attr('data-num');
            let counts = new CountUp(this, num, optionsCountUp);
            counts.start();
        });
    }

    $(document).on('click', '#drawerMenuToggle', function (e) {
        e.preventDefault();
        drawerMenu.removeClass('slideInRight').addClass('slideOutRight')
        drawerMenu.hide();
        setTimeout(function () {
            drawerMenu.removeClass('open').removeClass('slideOutRight').addClass('slideInRight');
        }, 700);

    })

})
if (window.innerWidth < 1050) {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
}
$(".close").click(function () {
    $(this).parent().fadeOut();
})


window.redirectToPath = function redirectToPath(path) {
    setTimeout(function () {
        window.location.href = path
    }, 200)
}

