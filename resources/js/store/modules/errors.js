export const namespaced = true;

export const state = {
    error: null,
};

export const mutations = {
    hideError(state) {
        state.error = null;
    },
    showError(state, error) {
        state.error = error;
    },
};
