<script>
    import {faLaravel} from '@fortawesome/free-brands-svg-icons';
    import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';

    export default {
        components: { FontAwesomeIcon },
        data() {
            return {
                appName: document.body.dataset.appName,
                homeUrl: document.body.dataset.homeUrl,
            };
        },
        computed: {
            faLaravel: () => faLaravel,
        },
    }
</script>

<style lang="scss">
    .navbar {
        // Make the dropdown menus appear over toasts
        z-index: 1200;
    }
</style>

<template>
    <nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">

        <!-- Logo -->
        <router-link class="navbar-brand" to="/list">
            <FontAwesomeIcon :icon="faLaravel" size="lg" class="mr-2"></FontAwesomeIcon>
            <span class="sr-only">Laravel</span>
            Migrations
            &ndash;
            {{ appName }}
        </router-link>

        <slot>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" :href="homeUrl">Back to Application</a>
                </li>
            </ul>
        </slot>

    </nav>
</template>
