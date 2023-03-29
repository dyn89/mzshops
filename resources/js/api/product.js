import { axios } from '@/utils/request'

// 创建产品分类
export function createCate (parameter) {
    return axios({
        url: '/product/cate',
        method: 'post',
        data: parameter,
        headers: {
            'Content-Type': 'multipart/form-data;charset=UTF-8'
        },
    })
}
// 获取分类列表
export function getCateList (parameter) {
    return axios({
        url: '/product/cate',
        method: 'get',
        data: parameter
    })
}
// 上架或下架
export function categoryUpDown (parameter) {
    return axios({
        url: '/cate/updown',
        method: 'post',
        data: parameter,
        
    })
}

