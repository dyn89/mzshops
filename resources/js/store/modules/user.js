import { getInfo } from '@/api/login'

const state = {
    userInfo: {},
}

const getters = {
    nickname: (state) => {
        return state.userInfo.em_name || ''
    }
}

const mutations = {
    SET_INFO: (state, info) => {
        state.userInfo = info
    }
}

const actions = {
    // 获取用户信息
    GetUserInfo ({ commit }) {
        return new Promise((resolve, reject) => {
            getInfo().then(response => {
                commit('SET_INFO', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
            })
    }
}


export default {
    state,
    getters,
    actions,
    mutations
}