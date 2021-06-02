// loads the Bootstrap jQuery plugins
import 'jquery'
import 'popper.js'
import 'bootstrap'
import '../scss/app.scss';
// loads the code syntax highlighting library
// import './highlight.js';

// Creates links to the Symfony documentation
import './doclinks.js';
import {CountUp} from 'countup.js';

require('animate.css')
window.CountUp = CountUp;
$(document).ready(function () {


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
})
