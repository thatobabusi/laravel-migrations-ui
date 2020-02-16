<script>
    import {faQuestionCircle} from '@fortawesome/free-solid-svg-icons';
    import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
    import {BDropdown, BDropdownDivider, BDropdownItem, VBTooltip} from 'bootstrap-vue';
    import {mapGetters, mapState} from 'vuex';
    import FreshButton from './FreshButton';
    import RunButton from './RunButton';
    import Spinner from './Spinner';

    export default {
        components: { BDropdown, BDropdownItem, BDropdownDivider, RunButton, FontAwesomeIcon, FreshButton, Spinner },
        directives: { BTooltip: VBTooltip },
        computed: {
            ...mapState('migrations', ['loading']),
            ...mapGetters('migrations', { migrations: 'getAllMigrations' }),
            faQuestionCircle: () => faQuestionCircle,
        },
    }
</script>

<template>
    <div class="card shadow-sm my-4">
        <div class="card-header bg-secondary text-white" style="line-height: 1.2; padding-left: 0.80em; padding-right: 0.80em;">
            <a href="https://laravel.com/docs/migrations" target="_blank" class="float-right text-white">
                <FontAwesomeIcon :icon="faQuestionCircle"></FontAwesomeIcon>
                Laravel Docs
            </a>
            <h6 class="m-0">
                Migrations
                <Spinner v-if="loading" class="ml-1"></Spinner>
            </h6>
        </div>
        <table class="table table-hover bg-white mb-0">

            <thead>
                <tr>
                    <th scope="col">Date / Time</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="align-middle font-weight-normal text-muted text-right">
                        <!--
                        <a href="#" class="btn btn-sm btn-primary font-weight-bold" style="width: 6em;">
                            New
                        </a>
                        -->
                        <FreshButton></FreshButton>
                    </th>
                </tr>
            </thead>

            <tbody v-if="migrations.length">
                <tr v-for="migration in migrations" :key="migration.name" :class="migration.isMissing ? 'table-danger' : ''">

                    <td class="align-middle">
                        <span v-if="migration.date">{{ migration.date }}</span>
                        <span v-else class="text-muted">(Unknown)</span>
                    </td>

                    <td class="align-middle">
                        <span v-b-tooltip.right="migration.relPath" class="pr-1">
                            <template v-if="migration.isMissing">
                                {{ migration.title }}
                                <span class="badge badge-danger">File Missing!</span>
                            </template>
                            <router-link v-else :to="`/migration-details/${migration.name}`" data-toggle="modal" data-target="#migration-popup" :data-path="migration.relPath">
                                {{ migration.title }}
                            </router-link>
                        </span>
                    </td>

                    <td class="align-middle">
                        <span v-if="migration.isApplied" class="badge badge-pill badge-success">Applied &ndash; Batch {{ migration.batch }}</span>
                        <span v-else class="badge badge-pill badge-warning">Pending</span>
                    </td>

                    <td class="align-middle text-right">
                        <RunButton :migration="migration"></RunButton>
                    </td>

                </tr>
            </tbody>
            <tbody v-else-if="loading">
                <tr>
                    <td colspan="4" class="text-muted">
                        <Spinner class="mr-2"></Spinner>
                        Loading...
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="4">
                        <em class="text-muted">No migrations found.</em>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</template>
