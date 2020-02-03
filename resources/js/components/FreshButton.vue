<script>
    import {faSpinner} from '@fortawesome/free-solid-svg-icons';
    import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
    import {BDropdown, BDropdownItem, BDropdownDivider} from 'bootstrap-vue';

    export default {
        name: 'FreshButton',
        components: { BDropdown, BDropdownItem, BDropdownDivider, FontAwesomeIcon },
        data() {
            return {
                running: false,
            };
        },
        computed: {
            faSpinner: () => faSpinner,
        },
    }
</script>

<template>
    <BDropdown style="width: 6.5em;" right size="sm" split variant="warning">

        <template v-slot:button-content>
            <template v-if="running">
                <FontAwesomeIcon :icon="faSpinner" spin></FontAwesomeIcon>
            </template>
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
