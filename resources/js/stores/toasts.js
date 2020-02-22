import Vue from 'vue';

let lastId = 0;

export default new Vue({
    data() {
        return {
            toasts: [],
        };
    },
    methods: {
        show(toasts) {
            for (let toast of toasts) {
                toast.id = ++lastId;
                this.toasts.push(toast);
            }
        },
        hide(toast) {
            const index = this.toasts.indexOf(toast);
            if (index > -1) {
                this.toasts.splice(index, 1);
            }
        },
    },
});
