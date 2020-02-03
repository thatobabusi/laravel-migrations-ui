<script>
    import {faPlug, faDatabase} from '@fortawesome/free-solid-svg-icons';
    import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';

    export default {
        name: 'TablesList',
        components: { FontAwesomeIcon },
        data() {
            return {
                connection: 'TODO',
                database: 'TODO',
                tables: [],
            };
        },
        computed: {
            faPlug: () => faPlug,
            faDatabase: () => faDatabase,
        },
    }
</script>

<template>
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white" style="line-height: 1.2; padding-left: 0.80em; padding-right: 0.80em;">
            <!--<div class="float-right" style="margin: -6px 0;">
            <span data-toggle="modal" data-target="#exampleModal2">
                <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Switch Database">
                    <i class="fas fa-fw fa-database" aria-hidden="true"></i>
                </button>
            </span>
            </div>-->
            <!--<span data-toggle="modal" data-target="#exampleModal2">-->
            <span style="cursor: default;" data-toggle="tooltip" data-placement="top" title="Connection">
                <FontAwesomeIcon :icon="faPlug" class="mr-1"></FontAwesomeIcon>
                {{ connection }}
            </span>
            <span style="cursor: default;" data-toggle="tooltip" data-placement="top" title="Database" class="ml-3">
                <FontAwesomeIcon :icon="faDatabase" class="mr-1"></FontAwesomeIcon>
                {{ database }}
            </span>
            <!--</span>-->
        </div>
        <table class="table table-hover bg-white mb-0">
            <thead>
                <tr>
                    <th scope="col">
                        Tables
                    </th>
                    <!--<th scope="col" class="align-middle font-weight-normal text-muted text-right">
                    <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="New Migration: Create Table">
                        <i class="fas fa-fw fa-plus" aria-hidden="true"></i>
                    </button>
                </th>-->
                </tr>
            </thead>
            <tbody v-if="tables.length">
                <tr v-for="table in tables">
                    <td class="align-middle">
                        <!--<a href="#">{{ table }}</a>-->
                        {{ table }}
                    </td>
                    <!--<td class="align-middle text-right">
                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View Structure">
                        <i class="fas fa-fw fa-search" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="New Migration: Modify">
                        <i class="fas fa-fw fa-pen" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="New Migration: Rename">
                        <i class="fas fa-fw fa-i-cursor" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="New Migration: Drop">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                    </td>-->
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="1"><em class="text-muted">No tables found.</em></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
