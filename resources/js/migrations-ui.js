// import 'bootstrap/js/dist/alert';
import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/modal';
// import 'bootstrap/js/dist/popover';
import 'bootstrap/js/dist/toast';
import 'bootstrap/js/dist/tooltip';

import $ from 'jquery';
import hljs from 'highlight.js/lib/highlight';

import './migration-popup';

// Configure highlight.js
hljs.registerLanguage('php', require('highlight.js/lib/languages/php'));

$(function () {
    // Initialise Bootstrap
    $('[data-toggle="tooltip"]').tooltip();
    // $('[data-toggle="popover"]').popover();
    $('.toast').toast('show');

    // Links with alternative methods (e.g. POST)
    const token = $('meta[name="csrf-token"]').attr('content');

    $('a[data-method]').click(function (event) {
        const $link = $(this);

        const $token = $('<input>')
            .attr('type', 'hidden')
            .attr('name', '_token')
            .attr('value', token);

        $('<form>')
            .attr('action', $link.attr('href'))
            .attr('method', $link.data('method'))
            .append($token)
            .appendTo(document.body)
            .get(0)
            .submit();

        event.preventDefault();
    });
});
