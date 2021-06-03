// loads the Bootstrap jQuery plugins
import 'jquery'
import 'popper.js'
import 'bootstrap'
import '../scss/app.scss';
// loads the code syntax highlighting library
// import './highlight.js';
import 'bootstrap-drawer/js/drawer'

// Creates links to the Symfony documentation
import './doclinks.js';
import {CountUp} from 'countup.js';

require('animate.css')
window.CountUp = CountUp;
$(document).ready(function () {
    let drawerMenu = $("#drawerMenu");

    const optionsCountUp = {
        useEasing: true,
        separator: '',
        decimal: '.'
    };
    $('.countup-numbers').each(function (index, element) {
        let num = $(this).attr('data-num');
        let counts = new CountUp(this, num, optionsCountUp);
        counts.start();
    });

    $(document).on('click', '#drawerMenuToggle', function (e) {
        e.preventDefault();
        drawerMenu.removeClass('slideInRight').addClass('slideOutRight')
        drawerMenu.hide();
        setTimeout(function () {
            drawerMenu.removeClass('open').removeClass('slideOutRight').addClass('slideInRight');
        }, 700);

    })
})
