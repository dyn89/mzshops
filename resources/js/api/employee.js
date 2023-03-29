import { axios } from '@/utils/request'

// 获取员工列表
export function getEmployees (parameter) {
    return axios({
        url: '/employee/list',
        method: 'get',
        params: parameter
    })
}

// 新建或编辑
export function patchEmployee (parameter) {
    return axios({
        url: '/employee/info',
        method: 'post',
        data: parameter
    })
}

// 删除
export function employeeDelApi (parameter) {
    return axios({
        url: '/employee/del',
        method: 'delete',
        params: parameter
    })
}

// 重置密码
export function resetPwdApi (parameter) {
    return axios({
        url: '/employee/resetpwd',
        method: 'post',
        data: parameter
    })
}

// 用户信息设置
export function accountSetting (parameter) {
    return axios({
        url: '/account/setting',
        method: 'post',
        data: parameter
    })
}
