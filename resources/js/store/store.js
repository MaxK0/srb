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
        setIsAsideOpen(state, value) {
            state.isAsideOpen = value;
        }
    },
});

export default store;
