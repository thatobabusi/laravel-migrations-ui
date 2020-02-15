import api from '../../api';

export const namespaced = true;

export const state = {
    loading: false,
    connection: null,
    database: null,
    migrations: [],
    tables: [],
};

export const mutations = {
    setLoading(state, loading) {
        state.loading = loading;
    },
    setAll(state, data) {
        state.loading = false;
        state.connection = data.connection;
        state.database = data.database;
        state.migrations = data.migrations;
        state.tables = data.tables;
    },
};

export const actions = {
    async load({ commit }) {
        commit('setLoading', true);

        try {
            const response = await api.get('list');
            commit('setAll', response.data);
        } catch {
            commit('setLoading', false);
        }
    },
};
