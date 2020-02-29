<script>
    import {BDropdown, BDropdownDivider, BDropdownItem} from 'bootstrap-vue';
    import migrations from '../stores/migrations';
    import Spinner from './Spinner';

    export default {
        components: { Spinner, BDropdown, BDropdownItem, BDropdownDivider },
        props: {
            migration: { type: Object, required: true },
            size: { type: String, default: '' },
            width: { type: String, default: undefined },
        },
        data() {
            return {
                migrations,
            };
        },
        computed: {
            variant() {
                if (this.migration.isMissing) {
                    return 'secondary'; // Grey
                } else if (this.migration.isApplied) {
                    return 'danger'; // Red
                } else {
                    return 'success'; // Green
                }
            },
        },
        methods: {
            migrateAll() {
                return this.migrations.migrateAll();
            },
            migrateSingle() {
                return this.migrations.migrateSingle(this.migration);
            },
            rollbackAll() {
                return this.migrations.rollbackAll();
            },
            rollbackBatch() {
                return this.migrations.rollbackBatch(this.migration.batch);
            },
            rollbackSingle() {
                return this.migrations.rollbackSingle(this.migration);
            },
            runDefault() {
                if (this.migration.isMissing) {
                    // TODO
                } else if (this.migration.isApplied) {
                    this.rollbackSingle();
                } else {
                    this.migrateSingle();
                }
            },
        },
    }
</script>

<template>
    <BDropdown v-if="!migration.isMissing" right :size="size" :style="{ width }" split :variant="variant" :disabled="migrations.running" @click="runDefault">

        <template v-slot:button-content>
            <Spinner v-if="migration.running"></Spinner>
            <template v-else-if="migration.isMissing">Fix</template>
            <template v-else-if="migration.isApplied">Rollback</template>
            <template v-else>Migrate</template>
        </template>

        <template v-if="migration.isMissing">
            <!-- TODO -->
            <BDropdownItem>Recreate File</BDropdownItem>
            <BDropdownItem>Update Filename</BDropdownItem>
            <BDropdownItem>Delete Record</BDropdownItem>
        </template>

        <template v-else-if="migration.isApplied">
            <BDropdownItem @click="rollbackSingle">This Migration</BDropdownItem>
            <BDropdownItem @click="rollbackBatch">Batch {{ migration.batch }}</BDropdownItem>
            <BDropdownItem @click="rollbackAll">All Migrations</BDropdownItem>
        </template>

        <template v-else>
            <BDropdownItem @click="migrateSingle">This Migration</BDropdownItem>
            <BDropdownItem @click="migrateAll">All Pending</BDropdownItem>
        </template>

    </BDropdown>
</template>
