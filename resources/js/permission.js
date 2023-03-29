import Vue from 'vue'
import router from './routes'
import store from './store'
import { ACCESS_TOKEN } from '@/store/mutation-types'

const whiteList = ['login', 'register']

router.beforeEach((to, from, next) => {
    if (Vue.ls.get(ACCESS_TOKEN)) {
        if (to.path === '/user/login') {
            next({ path: '/dashboard' })
        } else {
            if (store.getters.nickname === '') {
                store.dispatch('GetUserInfo')
            } else {
                next()
            }
        }
        next()
    } else {
        if (whiteList.includes(to.name)) {
            next()
        } else {
            next({ path: '/user/login', query: { redirect: to.fullPath } })
        }
    }
})


