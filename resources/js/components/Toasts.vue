<script>
    import {BToast, BToaster} from 'bootstrap-vue';
    import store from '../stores/toasts';

    export default {
        components: { BToast, BToaster },
        data() {
            return {
                store,
            };
        },
    }
</script>

<style lang="scss">
    .b-toaster-top-right {
        // Move below the navbar
        top: 3.5rem !important;
    }
</style>

<template>
    <div>

        <BToast
            v-for="toast in store.toasts"
            :key="toast.id"
            :title="toast.title"
            :variant="toast.variant"
            :visible="true"
            @hidden="store.hide(toast)"
        >

            <div class="pre-wrap">{{ toast.message }}</div>

            <div v-if="toast.runtime" class="small text-muted">
                in {{ toast.runtime }} seconds
            </div>

        </BToast>

    </div>
</template>
