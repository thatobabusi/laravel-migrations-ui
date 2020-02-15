import api from '../../api';

export const namespaced = true;

export const state = {
    loading: false,
    name: null,
    source: null,
};

export const mutations = {
    clearData(state) {
        state.name = null;
        state.source = null;
    },
    setLoading(state, loading) {
        state.loading = loading;
    },
    setAll(state, data) {
        state.loading = false;
        state.name = data.name;
        state.source = data.source;
    },
};

export const actions = {
    async load({ commit, state }, name) {
        commit('setLoading', true);

        if (name !== state.name) {
            commit('clearData', true);
        }

        try {
            const response = await api.get(`migration-details/${name}`);
            commit('setAll', response.data);
        } catch {
            commit('setLoading', false);
        }
    },
};
