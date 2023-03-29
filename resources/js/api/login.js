import { axios } from '@/utils/request'

const userApi = {
    Login: '/auth/login',
    Logout: '/auth/logout',
    UserInfo: '/user/info',
}

export function login (parameter) {
    return axios({
        url: userApi.Login,
        method: 'post',
        data: parameter
    })
}

export function getInfo () {
    return axios({
        url: userApi.UserInfo,
        method: 'get',
        headers: {
            'Content-Type': 'application/json;charset=UTF-8'
        }
    })
}

export function logout () {
    return axios({
        url: userApi.Logout,
        method: 'post',
        headers: {
            'Content-Type': 'application/json;charset=UTF-8'
        }
    })
}
