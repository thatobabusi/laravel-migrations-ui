<script>
    import Code from '../components/Code';
    import MigrationsList from '../components/MigrationsList';
    import Navbar from '../components/Navbar';
    import RunButton from '../components/RunButton';
    import Spinner from '../components/Spinner';
    import TablesList from '../components/TablesList';
    import refresh from '../mixins/refresh';
    import migrations from '../stores/migrations';

    export default {
        components: { RunButton, Spinner, Code, MigrationsList, Navbar, TablesList },
        mixins: [refresh],
        props: {
            name: { type: String, required: true },
        },
        data() {
            return {
                migrations,
            };
        },

        computed: {
            migration() {
                return this.migrations.getMigration(this.name);
            },
        },
        watch: {
            name: 'refresh',
        },
        mounted() {
            this.migrations.loadDetails(this.name);
        },
        methods: {
            refresh() {
                this.migrations.loadDetails(this.name);
            },
        },
        metaInfo() {
            return { title: this.name };
        },
    }
</script>

<template>
    <div>

        <Navbar>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <RunButton :migration="migration"></RunButton>
                </li>
            </ul>
        </Navbar>

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
