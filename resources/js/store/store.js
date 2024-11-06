import { createStore } from "vuex";

const store = createStore({
    state() {
        return {
            isAsideOpen: false,
        };
    },
    mutations: {
        toggleIsAsideOpen(state) {
            state.isAsideOpen = !state.isAsideOpen;
        },
    },
});

export default store;
