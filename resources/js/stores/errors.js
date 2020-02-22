import Vue from 'vue';

export default new Vue({
    data() {
        return {
            title: null,
            html: null,
        };
    },
    methods: {
        show(title, html) {
            this.title = title;
            this.html = html;
        },
        hide() {
            this.html = null;
        },
    },
});
