import api from '../../api';

export const namespaced = true;

export const state = {
    loading: false,
    migrations: [],
};

export const mutations = {
    setLoading(state, loading) {
        state.loading = loading;
    },
    setAll(state, migrations) {
        state.loading = false;
        state.migrations = migrations;
    },
};

export const actions = {
    async load({ commit }) {
        commit('setLoading', true);

        try {
            const response = await api.get('migrations');
            commit('setAll', response.data);
        } catch {
            commit('setLoading', false);
        }
    },
};
