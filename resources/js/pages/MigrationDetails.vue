<script>
    import {mapActions, mapState} from 'vuex';
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
            ...mapState('migration-details', ['loading', 'source']),
        },
        watch: {
            name: 'refresh',
        },
        mounted() {
            this.load(this.name);
        },
        methods: {
            ...mapActions('migration-details', ['load']),
            refresh() {
                this.load(this.name);
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

        <div class="card shadow-sm m-3">
            <div class="card-header bg-secondary text-white" style="line-height: 1.2; padding-left: 0.80em; padding-right: 0.80em;">
                <h6 class="m-0">
                    {{ name }}
                    <Spinner v-if="loading" class="ml-1"></Spinner>
                </h6>
            </div>
            <Code class="m-0" :code="source || '# Loading...'"></Code>
        </div>

    </div>
</template>
