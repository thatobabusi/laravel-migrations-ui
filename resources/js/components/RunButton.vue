<script>
    import {BDropdown, BDropdownDivider, BDropdownItem} from 'bootstrap-vue';
    import migrations from '../stores/migrations';
    import Spinner from './Spinner';

    export default {
        components: { Spinner, BDropdown, BDropdownItem, BDropdownDivider },
        props: {
            migration: { type: Object, required: true },
            size: { type: String, default: '' },
        },
        data() {
            return {
                migrations,
            };
        },
        computed: {
            running() {
                return this.migrations.running || this.migration.running;
            },
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
            applyAll() {
                return this.migrations.applyAll();
            },
            applySingle() {
                return this.migrations.applySingle(this.migration);
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
                    this.applySingle();
                }
            },
        },
    }
</script>

<template>
    <BDropdown v-if="!migration.isMissing" right :size="size" split :variant="variant" :disabled="running" @click="runDefault">

        <template v-slot:button-content>
            <Spinner v-if="running"></Spinner>
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
            <BDropdownItem @click="applySingle">This Migration</BDropdownItem>
            <BDropdownItem @click="applyAll">All Pending</BDropdownItem>
        </template>

    </BDropdown>
</template>
