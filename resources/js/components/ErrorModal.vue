<script>
    import {BModal} from 'bootstrap-vue';
    import errors from '../stores/errors';

    export default {
        components: { BModal },
        data() {
            return {
                errors,
            };
        },
        mounted() {
            this.setContent();
        },
        watch: {
            'errors.html': function() {
                this.setContent();
            },
        },
        methods: {
            async setContent() {
                // Not sure why but two next ticks are needed
                await this.$nextTick();
                await this.$nextTick();

                if (!this.errors.html) return;

                const iframeDocument = this.$refs.iframe.contentWindow.document;
                iframeDocument.open();
                iframeDocument.write(this.errors.html);
                iframeDocument.close();
            },
        },
    }
</script>

<template>
    <BModal :visible="!!errors.html" @hide="errors.hide" size="xl" title="Error" body-class="p-0" hide-footer>
        <iframe class="error-modal-iframe" ref="iframe"></iframe>
    </BModal>
</template>

<style>
    .error-modal-iframe {
        border: 0;
        display: block;
        height: calc(100vh - 7.5rem);
        width: 100%;
    }
</style>
