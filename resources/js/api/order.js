import { axios } from '@/utils/request'

// 获取订单列表
export function getOrderLists (parameter) {
    return axios({
        url: '/order/list',
        method: 'get',
        params: parameter
    })
}