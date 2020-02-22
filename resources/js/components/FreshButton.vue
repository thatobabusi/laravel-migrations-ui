<script>
    import {BDropdown, BDropdownItem, BDropdownDivider} from 'bootstrap-vue';
    import migrations from '../stores/migrations';
    import Spinner from './Spinner';

    export default {
        components: { Spinner, BDropdown, BDropdownItem, BDropdownDivider },
        props: {
            size: { type: String, default: '' },
        },
        data() {
            return {
                migrations,
            };
        },
    }
</script>

<template>
    <BDropdown right :size="size" split variant="warning" :disabled="migrations.running" @click="migrations.fresh(true)">

        <template v-slot:button-content>
            <Spinner v-if="migrations.running"></Spinner>
            <template v-else>Fresh</template>
        </template>

        <BDropdownItem @click="migrations.fresh(false)">
            Fresh
            <small class="d-block text-muted">Drop tables &amp; run all migrations</small>
        </BDropdownItem>

        <BDropdownItem @click="migrations.fresh(true)">
            Fresh + Seed <small class="text-muted">(Default)</small>
        </BDropdownItem>

        <BDropdownDivider></BDropdownDivider>

        <BDropdownItem @click="migrations.refresh(false)">
            Refresh
            <small class="d-block text-muted">Rollback &amp; re-run all migrations</small>
        </BDropdownItem>

        <BDropdownItem @click="migrations.refresh(true)">
            Refresh + Seed
        </BDropdownItem>

        <BDropdownDivider></BDropdownDivider>

        <BDropdownItem @click="migrations.seed()">
            Seed only
        </BDropdownItem>

    </BDropdown>
</template>
