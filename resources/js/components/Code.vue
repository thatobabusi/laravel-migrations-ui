<script>
    import hljs from 'highlight.js/lib/highlight';

    // Configure highlight.js
    hljs.registerLanguage('php', require('highlight.js/lib/languages/php'));

    export default {
        mixins: [],
        props: {
            code: { type: String, required: true },
        },
        computed: {
            highlighted() {
                return hljs.highlight('php', this.code).value;
            },
        },
    }
</script>

<template>
    <pre class="hljs" v-html="highlighted"></pre>
</template>
