<script>
    import ErrorModal from './components/ErrorModal';
    export default {
        name: 'App',
        components: { ErrorModal },
    }
</script>

<template>
    <div>
        <RouterView></RouterView>
        <ErrorModal></ErrorModal>
    </div>
</template>
