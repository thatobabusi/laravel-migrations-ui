// // import 'bootstrap/js/dist/alert';
// import 'bootstrap/js/dist/dropdown';
// import 'bootstrap/js/dist/modal';
// // import 'bootstrap/js/dist/popover';
// import 'bootstrap/js/dist/toast';
// import 'bootstrap/js/dist/tooltip';
//
// import hljs from 'highlight.js/lib/highlight';
// import $ from 'jquery';
//
// const $popup = $('#migration-popup');
// const $title = $('#migration-popup-title');
// const $code = $('#migration-popup-code');
// let ajax = null;
//
// function setCode(code) {
//     $code.text(code);
// }
//
//
// $popup.on('show.bs.modal', function (event) {
//     if (ajax) {
//         ajax.abort();
//     }
//
//     const $link = $(event.relatedTarget);
//
//     $title.text($link.data('path'));
//     setCode('// Loading...');
//
//     ajax = $.ajax({
//         method: 'get',
//         url: $link.attr('href'),
//         success(migration) {
//             setCode(migration.source);
//         },
//         error(jqXHR, textStatus, errorThrown) {
//             if (textStatus !== 'abort') {
//                 alert('Failed to load migration data');
//                 $popup.modal('hide');
//             }
//         },
//     });
// });
//
// $(function () {
//     // Initialise Bootstrap
//     $('[data-toggle="tooltip"]').tooltip();
//     // $('[data-toggle="popover"]').popover();
//     $('.toast').toast('show');
//
//     // Links with alternative methods (e.g. POST)
//     const token = $('meta[name="csrf-token"]').attr('content');
//
//     $('a[data-method]').click(function (event) {
//         const $link = $(this);
//
//         const $token = $('<input>')
//             .attr('type', 'hidden')
//             .attr('name', '_token')
//             .attr('value', token);
//
//         $('<form>')
//             .attr('action', $link.attr('href'))
//             .attr('method', $link.data('method'))
//             .append($token)
//             .appendTo(document.body)
//             .get(0)
//             .submit();
//
//         event.preventDefault();
//     });
// });

import './setup';

import App from './App';
import Vue from 'vue';
import VueMeta from 'vue-meta';
import VueRouter from 'vue-router';

Vue.use(VueMeta);
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: document.body.dataset.baseUrl,
    routes: require('./routes').default,
});

new Vue({
    ...App,
    el: '#app',
    metaInfo: {
        titleTemplate: '%s – ' + document.body.dataset.appName,
        title: 'MISSING TITLE',
    },
    router,
});
