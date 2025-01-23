import { createStore } from "vuex";

const store = createStore({
    state() {
        return {
            isAsideOpen: false,
            branches: [],
        };
    },
    mutations: {
        toggleIsAsideOpen(state) {
            state.isAsideOpen = !state.isAsideOpen;
        },
        setIsAsideOpen(state, value) {
            state.isAsideOpen = value;
        },
        setBranches(state, branches) {
            state.branches = branches;
        },
    },
});

export default store;
