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

window.IScroll = require('iscroll')

require('jqvmap/dist/jquery.vmap');
require('jqvmap/dist/maps/jquery.vmap.europe');
require('jquery.waitforimages')
require('animate.css');
require('textillate/assets/jquery.fittext')
require('textillate/assets/jquery.lettering')
require('textillate/jquery.textillate')
require('./fullpage/jquery.fullpage')
require('./fullpage/jquery.easings.min')

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
    $(".lettersAnimation").each(function () {
        $(this).html($(this).html().replace(/\s+/g, " "))
    })

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

    window.initLettersAnimation = function () {
        $(".lettersAnimation").textillate('start');
    }
    window.initCountUpAnimation = function countUp() {
        $('.countup-numbers').each(function (index, element) {
            let num = $(this).attr('data-num');
            let counts = new CountUp(this, num, optionsCountUp);
            counts.start();
        });
    }
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
                    initCountUpAnimation()
                }
            } else {
                if (countUpAnimationState !== $(this).isInViewport()) {
                    countUpAnimationState = $(this).isInViewport();
                    initCountUpAnimation()
                }
            }
        })
    })


    $(document).on('click', '#drawerMenuToggle', function (e) {
        e.preventDefault();
        drawerMenu.removeClass('slideInRight').addClass('slideOutRight')
        drawerMenu.hide();
        setTimeout(function () {
            drawerMenu.removeClass('open').removeClass('slideOutRight').addClass('slideInRight');
        }, 700);

    })


    function appearAnimation(el) {
        var text = $(el).html();
        $(el).html('');
        var textElements = text.split("").map(function (c) {
            return $('<span style="visibility: hidden" id="' + c + '">' + c + '</span>');
        });
        var delay = 100; // Tune this for different letter delays.
        var wordDelay = 0;

        if ($(el).data('delay')) {
            delay = $(el).data('delay');
        }
        if ($(el).data('word-delay')) {
            wordDelay = $(el).data('word-delay');
        }
        textElements.forEach(function (e, i) {
            el.append(e);
        })
        var Letters = $(el).find('span');

        setTimeout(function () {
            $(Letters).each(function (i, e) {
                setTimeout(function () {
                    $(e).addClass('animated').addClass('fadeIn').css('visibility', 'visible');
                    $(e).show()
                }, 100 + i * delay)
            })
        }, wordDelay)

    }

    $(".fadeInTextAnimation").each(function () {
        appearAnimation($(this));
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
    }, 400)
}

AOS.init()

let scrollBgPosArray = $(".scroll").css('background-position-y').split(',');
let scrollStartingPos = 0;
try {
    scrollStartingPos = parseInt((scrollBgPosArray[1].split('px'))[0]);
} catch (exception) {
}

function simpleParallax() {
    //This variable is storing the distance scrolled
    var scrolled = $(window).scrollTop() + 1;
    //Every element with the class "scroll" will have parallax background
    //Change the "0.3" for adjusting scroll speed.
    let value = scrollStartingPos + -(scrolled * 0.3) + 'px';
    $('.scroll').css('background-position-y', value);
}


//Everytime we scroll, it will fire the function
$(window).scroll(function (e) {
    simpleParallax();
});
