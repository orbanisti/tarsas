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
