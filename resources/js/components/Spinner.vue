<script>
    import {faSpinner} from '@fortawesome/free-solid-svg-icons';
    import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';

    export default {
        components: { FontAwesomeIcon },
        computed: {
            faSpinner: () => faSpinner,
        },
    }
</script>

<template>
    <FontAwesomeIcon :icon="faSpinner" spin></FontAwesomeIcon>
</template>
