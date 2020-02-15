<script>
    import {BModal} from 'bootstrap-vue';
    import {mapMutations, mapState} from 'vuex';

    export default {
        name: 'ErrorModal',
        components: { BModal },
        computed: {
            ...mapState('errors', ['error']),
        },
        mounted() {
            this.setContent();
        },
        watch: {
            error() {
                this.setContent();
            },
        },
        methods: {
            ...mapMutations('errors', ['hideError']),
            async setContent() {
                // Not sure why but two next ticks are needed
                await this.$nextTick();
                await this.$nextTick();

                if (!this.error) return;

                const iframeDocument = this.$refs.iframe.contentWindow.document;
                iframeDocument.open();
                iframeDocument.write(this.error);
                iframeDocument.close();
            },
        },
    }
</script>

<template>
    <BModal :visible="!!error" @hide="hideError" size="xl" title="Error" body-class="p-0" hide-footer>
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
