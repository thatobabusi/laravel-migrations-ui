<script>
    import {BDropdown, BDropdownDivider, BDropdownItem} from 'bootstrap-vue';
    import {mapActions} from 'vuex';
    import Spinner from './Spinner';

    export default {
        components: { Spinner, BDropdown, BDropdownItem, BDropdownDivider },
        props: {
            migration: { type: Object, required: true },
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
            ...mapActions('migrations', ['runSingle']),
            applySingle() {
                return this.runSingle({ name: this.migration.name, type: 'apply' });
            },
            rollbackSingle() {
                return this.runSingle({ name: this.migration.name, type: 'rollback' });
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
    <BDropdown style="width: 6.5em;" right size="sm" split :variant="variant" @click="runDefault">

        <template v-slot:button-content>
            <Spinner v-if="migration.running"></Spinner>
            <template v-else-if="migration.isMissing">Fix</template>
            <template v-else-if="migration.isApplied">Rollback</template>
            <template v-else>Apply</template>
        </template>

        <template v-if="migration.isMissing">
            <BDropdownItem>Recreate File</BDropdownItem>
            <BDropdownItem>Update Filename</BDropdownItem>
            <BDropdownItem>Delete Record</BDropdownItem>
        </template>

        <template v-else-if="migration.isApplied">
            <BDropdownItem @click="rollbackSingle">Rollback This Migration</BDropdownItem>
            <BDropdownItem>Rollback Batch {{ migration.batch }}</BDropdownItem>
            <BDropdownItem>Rollback All</BDropdownItem>
        </template>

        <template v-else>
            <BDropdownItem @click="applySingle">Apply This Migration</BDropdownItem>
            <BDropdownItem>Apply All Pending</BDropdownItem>
        </template>

    </BDropdown>
</template>
