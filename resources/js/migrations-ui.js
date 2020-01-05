import 'bootstrap/js/dist/alert';
import 'bootstrap/js/dist/dropdown';
// import 'bootstrap/js/dist/popover';
import 'bootstrap/js/dist/tooltip';

import hljs from 'highlight.js/lib/highlight';

import $ from 'jquery';

// Initialise Bootstrap
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    // $('[data-toggle="popover"]').popover();
});

// Configure highlight.js
hljs.registerLanguage('php', require('highlight.js/lib/languages/php'));
