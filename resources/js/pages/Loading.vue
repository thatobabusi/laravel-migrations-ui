<script>
    import Navbar from '../components/Navbar';
    export default {
        components: { Navbar },
        metaInfo: {
            title: 'Loading... — Migrations',
        },
    }
</script>

<template>
    <div>

        <Navbar></Navbar>

        <div class="loading">
            Loading...
        </div>

    </div>
</template>
