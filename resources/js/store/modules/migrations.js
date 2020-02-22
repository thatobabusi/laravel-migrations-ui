import Vue from 'vue';
import api from '../../api';
import Migration from '../../models/Migration';

export const namespaced = true;

export const state = {
    connection: null,
    database: null,
    loading: false,
    migrationDetails: {},
    migrationNames: [],
    tables: [],
};

function getMigrationDetails(state, name) {
    if (!(name in state.migrationDetails)) {
        Vue.set(state.migrationDetails, name, new Migration(name));
    }

    return state.migrationDetails[name];
}

export const getters = {
    getAllMigrations(state) {
        return state.migrationNames.map(name => state.migrationDetails[name]);
    },
    getMigration(state) {
        return name => getMigrationDetails(state, name);
    },
};

export const mutations = {
    setAll(state, data) {
        state.connection = data.connection;
        state.database = data.database;
        state.tables = data.tables;

        // Split the migrations list into a list of names and a map of details
        let migrationNames = [];

        for (let migration of data.migrations) {
            migrationNames.push(migration.name);
            getMigrationDetails(state, migration.name).update(migration);
        }

        state.migrationNames = migrationNames;
    },
    setLoading(state, loading) {
        state.loading = loading;
    },
    setMigrationDetails(state, data) {
        getMigrationDetails(state, data.name).update(data);
    },
};

export const actions = {
    async load({ commit }) {
        commit('setLoading', true);

        try {
            const response = await api.get('list');
            commit('setAll', response.data);
        } finally {
            commit('setLoading', false);
        }
    },
    async loadDetails({ commit }, name) {
        commit('setMigrationDetails', { name, loading: true });

        try {
            const response = await api.get(`migration-details/${name}`);
            commit('setMigrationDetails', response.data);
        } finally {
            commit('setMigrationDetails', { name, loading: false });
        }
    },
    async runSingle({ commit }, { name, type }) {
        commit('setMigrationDetails', { name, running: true });

        try {
            // 'type' can be 'apply' or 'rollback'
            const response = await api.post(`${type}-single/${name}`);
            commit('setAll', response.data);
        } finally {
            commit('setMigrationDetails', { name, running: false });
        }
    },
};
