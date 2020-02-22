<script>
    import ErrorModal from './components/ErrorModal';
    import Toasts from './components/Toasts';

    export default {
        components: { ErrorModal, Toasts },
        metaInfo: {
            titleTemplate(title) {
                return [title, 'Migrations', document.body.dataset.appName]
                    .filter(Boolean)
                    .join(' – ');
            },
        },
    }
</script>

<template>
    <div>
        <RouterView></RouterView>
        <ErrorModal></ErrorModal>
        <Toasts></Toasts>
    </div>
</template>
