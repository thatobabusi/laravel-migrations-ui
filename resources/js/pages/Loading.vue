<script>
    import Navbar from '../components/Navbar';
    export default {
        components: { Navbar },
        mounted() {
            console.log('Loading...');
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
