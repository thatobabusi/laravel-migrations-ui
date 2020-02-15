export default {
    mounted() {
        window.addEventListener('keydown', this.$_refresh_keyDown);
    },
    destroyed() {
        window.removeEventListener('keydown', this.$_refresh_keyDown);
    },
    methods: {
        /**
         * @param event {KeyboardEvent}
         */
        $_refresh_keyDown(event) {
            if (
                // F5 but not with Ctrl
                (event.code === 'F5' && !event.ctrlKey) ||
                // Ctrl-R
                (event.ctrlKey && event.code === 'KeyR')
            ) {
                event.preventDefault();
                this.refresh();
            }
        },
    },
}
