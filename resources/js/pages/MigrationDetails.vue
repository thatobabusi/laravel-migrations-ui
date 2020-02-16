<script>
    import {mapActions, mapGetters} from 'vuex';
    import Code from '../components/Code';
    import MigrationsList from '../components/MigrationsList';
    import Navbar from '../components/Navbar';
    import Spinner from '../components/Spinner';
    import TablesList from '../components/TablesList';
    import refresh from '../mixins/refresh';

    export default {
        components: { Spinner, Code, MigrationsList, Navbar, TablesList },
        mixins: [refresh],
        props: {
            name: { type: String, required: true },
        },
        computed: {
            ...mapGetters('migrations', ['getMigration']),
            migration() {
                return this.getMigration(this.name);
            },
        },
        watch: {
            name: 'refresh',
        },
        mounted() {
            this.loadDetails(this.name);
        },
        methods: {
            ...mapActions('migrations', ['loadDetails']),
            refresh() {
                this.loadDetails(this.name);
            },
        },
        metaInfo() {
            return {
                title: `Migration Details: ${this.name}`,
            };
        },
    }
</script>

<template>
    <div>

        <Navbar></Navbar>

        <div class="card shadow-sm m-4">
            <div class="card-header bg-secondary text-white" style="line-height: 1.2; padding-left: 0.80em; padding-right: 0.80em;">
                <h6 class="m-0">
                    {{ name }}.php
                    <Spinner v-if="migration.loading" class="ml-1"></Spinner>
                </h6>
            </div>
            <Code class="m-0 p-3" :code="migration.source || '# Loading...'"></Code>
        </div>

    </div>
</template>
