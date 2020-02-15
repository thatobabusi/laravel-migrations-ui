<script>
    import Navbar from '../components/Navbar';

    export default {
        components: { Navbar },
        metaInfo: {
            title: 'Page Not Found – Migrations',
        },
    }
</script>

<template>
    <div>
        <Navbar></Navbar>
        <div class="m-5 text-center">
            <p class="display-4">Page Not Found</p>
            <p><router-link to="/list">Home</router-link></p>
        </div>
    </div>
</template>
