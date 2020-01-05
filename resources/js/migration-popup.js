import hljs from 'highlight.js/lib/highlight';
import $ from 'jquery';

const $popup = $('#migration-popup');
const $title = $('#migration-popup-title');
const $code = $('#migration-popup-code');
let ajax = null;

function setCode(code) {
    $code.text(code);
    hljs.highlightBlock($code[0]);
}


$popup.on('show.bs.modal', function (event) {
    if (ajax) {
        ajax.abort();
    }

    const $link = $(event.relatedTarget);

    $title.text($link.data('path'));
    setCode('// Loading...');

    ajax = $.ajax({
        method: 'get',
        url: $link.attr('href'),
        success(migration) {
            setCode(migration.source);
        },
        error(jqXHR, textStatus, errorThrown) {
            if (textStatus !== 'abort') {
                alert('Failed to load migration data');
                $popup.modal('hide');
            }
        },
    });
});
