import Vue from 'vue'
import Vuex from 'vuex'
import createMultiTabState from 'vuex-multi-tab-state'

import user from './modules/user'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        user
    },
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    plugins: [createMultiTabState({
        statesPaths: []
    })]
})