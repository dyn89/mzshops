import Vue from 'vue'
import axios from 'axios'
import notification from 'ant-design-vue/es/notification'
import { ACCESS_TOKEN } from '@/store/mutation-types'

// 创建 axios 实例
const service = axios.create({
    baseURL: '/api/v1', // api base_url
    timeout: 60000, // 请求超时时间
    withCredentials: true
})

const err = (error) => {
    if (error.response) {
        console.log('error.response', error.response)
        const data = error.response.data
        if (error.response.status === 422) {
          notification.error({
            message: data.message,
            description: JSON.stringify(data.errors),
            style: 'white-space:pre-line'
          })
        }
        if (error.response.status === 500) {
          notification.error({
            message: data.message || '请求出错',
            description: data.data || error.response.statusText || '',
          })
        }
        if (error.response.status === 404) {
          notification.error({
            message: data.message || '请求出错',
            description: data.data || error.response.statusText || '',
          })
        }
        if (error.response.status === 403) {
          notification.error({
            message: 'Forbidden',
            description: data.message || data.msg
          })
        }
        if (error.response.status === 401) {
          notification.error({
            message: 'Unauthorized',
            description: '登录异常，请重新登录！'
          })
          this.$router.push({ name: 'login' })  
        }
      }
      return Promise.reject(error)
}

// request interceptor
service.interceptors.request.use(config => {
  const token = Vue.ls.get(ACCESS_TOKEN)
  if (token) {
    config.headers.Authorization = token
  }
  return config
}, err)

// response interceptor
service.interceptors.response.use((response) => {
    console.log('axios.res', response)
    return response.data
}, err)

export {
    service as axios
}
