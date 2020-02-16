<script>
    import ErrorModal from './components/ErrorModal';
    export default {
        components: { ErrorModal },
    }
</script>

<template>
    <div>
        <RouterView></RouterView>
        <ErrorModal></ErrorModal>
    </div>
</template>
