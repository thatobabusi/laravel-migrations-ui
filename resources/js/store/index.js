import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

// Automatically load all modules
const requireModule = require.context('./modules', false, /\.js$/);
const modules = {};

requireModule.keys().forEach(filename => {
    const name = filename.replace(/^\.\/(.+)\.js$/, '$1');
    modules[name] = requireModule(filename);
});

export default new Vuex.Store({
    modules,
    strict: process.env.NODE_ENV !== 'production',
})
