<script>
    import ErrorModal from './components/ErrorModal';
    import Toasts from './components/Toasts';

    export default {
        components: { ErrorModal, Toasts },
    }
</script>

<template>
    <div>
        <RouterView></RouterView>
        <ErrorModal></ErrorModal>
        <Toasts></Toasts>
    </div>
</template>
