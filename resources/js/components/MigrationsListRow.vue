<script>
    import {BDropdown, BDropdownDivider, BDropdownItem, VBTooltip} from 'bootstrap-vue';

    export default {
        name: 'MigrationsListRow',
        props: {
            migration: { type: Object, required: true },
        },
        components: { BDropdown, BDropdownItem, BDropdownDivider },
        directives: { BTooltip: VBTooltip },
        data() {
            return {
                running: false,
            };
        },
    }
</script>

<template>
    <tr :class="migration.isMissing ? 'table-danger' : ''">

        <td class="align-middle">
            <!-- The tooltip is around the date not the title because it interferes with moving the mouse over links -->
            <span v-b-tooltip.right="migration.relPath">
                <span v-if="migration.date">{{ migration.date }}</span>
                <span v-else class="text-muted">(Unknown)</span>
            </span>
        </td>

        <td class="align-middle">
            <template v-if="migration.isMissing">
                {{ migration.title }}
                <span class="badge badge-danger">File Missing!</span>
            </template>
            <router-link v-else :to="`/migration-details/${migration.name}`" data-toggle="modal" data-target="#migration-popup" :data-path="migration.relPath">
                {{ migration.title }}
            </router-link>
        </td>

        <td class="align-middle">
            <span v-if="migration.isApplied" class="badge badge-pill badge-success">Applied &ndash; Batch {{ migration.batch }}</span>
            <span v-else class="badge badge-pill badge-warning">Pending</span>
        </td>

        <td class="align-middle text-right">
            <div class="btn-group">

                <template v-if="migration.isMissing">
                    <!--
                    <a class="btn btn-sm btn-secondary" style="width: 5em;" data-method="post" href="#">
                        Fix
                    </a>
                    <button class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" type="button" id="migration-dropdown-button-{{ $loop->index }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="migration-dropdown-button-{{ $loop->index }}">
                        <a class="dropdown-item" data-method="post" href="#">Recreate File</a>
                        <a class="dropdown-item" data-method="post" href="#">Update Filename</a>
                        <a class="dropdown-item" data-method="post" href="#">Delete Record</a>
                    </div>
                    -->
                </template>

                <template v-else-if="migration.isApplied">
                    <!--<a class="btn btn-sm btn-danger" style="width: 5em;">&lt;!&ndash;route('migrations-ui.rollback', $migration)&ndash;&gt;
                        Rollback
                    </a>
                    <button class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split" type="button" id="migration-dropdown-button-{{ $loop->index }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                        <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.rollback', $migration) }}">
                            Rollback This Migration
                        </a>
                        <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.rollback-batch', $migration->batch) }}">
                            Rollback Batch {{ $migration->batch }}
                        </a>
                        <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.rollback-all') }}">
                            Rollback All
                        </a>
                    </div>-->
                </template>

                <template v-else>
                    <!--<a class="btn btn-sm btn-success" style="width: 5em;" data-method="post" href="{{ route('migrations-ui.apply', $migration) }}">
                        Apply
                    </a>
                    <button class="btn btn-sm btn-success dropdown-toggle dropdown-toggle-split" type="button" id="migration-dropdown-button-{{ $loop->index }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="migration-dropdown-button-{{ $loop->index }}">
                        <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.apply', $migration) }}">
                            Apply This Migration
                        </a>
                        <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.apply-all') }}">
                            Apply All Pending
                        </a>
                    </div>-->
                </template>

            </div>
        </td>

    </tr>
</template>
