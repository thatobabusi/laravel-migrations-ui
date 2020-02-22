import Vue from 'vue';

export default new Vue({
    data() {
        return {
            html: null,
        };
    },
    methods: {
        show(html) {
            this.html = html;
        },
        hide() {
            this.html = null;
        },
    },
});
