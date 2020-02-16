<script>
    import {BDropdown, BDropdownItem, BDropdownDivider} from 'bootstrap-vue';
    import Spinner from './Spinner';

    export default {
        components: { Spinner, BDropdown, BDropdownItem, BDropdownDivider },
        data() {
            return {
                running: false,
            };
        },
    }
</script>

<template>
    <BDropdown style="width: 6.5em;" right size="sm" split variant="warning">

        <template v-slot:button-content>
            <Spinner v-if="running"></Spinner>
            <template v-else>Fresh</template>
        </template>

        <BDropdownItem><!-- route('migrations-ui.fresh') -->
            Fresh
            <small class="d-block text-muted">Drop tables &amp; apply all migrations</small>
        </BDropdownItem>

        <BDropdownItem><!-- route('migrations-ui.fresh', ['seed' => true]) -->
            Fresh + Seed <small class="text-muted">(Default)</small>
        </BDropdownItem>

        <BDropdownDivider></BDropdownDivider>

        <BDropdownItem><!-- route('migrations-ui.refresh') -->
            Refresh
            <small class="d-block text-muted">Rollback &amp; apply all migrations</small>
        </BDropdownItem>

        <BDropdownItem><!-- route('migrations-ui.refresh', ['seed' => true]) -->
            Refresh + Seed
        </BDropdownItem>

        <BDropdownDivider></BDropdownDivider>

        <BDropdownItem><!-- route('migrations-ui.seed') -->
            Seed only
        </BDropdownItem>

    </BDropdown>
</template>
