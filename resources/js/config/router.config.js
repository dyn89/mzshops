import { BasicLayout, PageView, UserLayout } from "@/pages/layouts"
import Vue from "vue"

export const asyncRouterMap = [
    {
        path: '/',
        name: 'index',
        component: BasicLayout,
        meta: { title: '首页' },
        redirect: '/dashboard',
        children: [
            {
                path: '/dashboard',
                name: 'Dashboard',
                component: PageView,
                meta: { title: '仪表盘', icon: 'dashboard' },
                redirect: '/dashboard/analysis',
                children: [
                    {
                        path: '/dashboard/analysis',
                        name: 'DashboardAnalysis',
                        component: Vue.component( 'DashboardAnalysis', require( '@/pages/dashboard/Analysis.vue' ).default ),
                        meta: { title: '分析页' },
                    }
                ]
            },
            // {
            //     path: '/order',
            //     name: 'Order',
            //     component: PageView,
            //     meta: { title: '订单管理', icon: 'bars' },
            //     redirect: '/order/lists',
            //     children: [
            //         {
            //             path: '/order/lists',
            //             name: 'OrderLists',
            //             component: Vue.component( 'OrderList', require( '@/pages/order/Lists.vue' ).default ),
            //             meta: { title: '订单列表' },
            //         }
            //     ]
            // },
            {
                path: '/product',
                name: 'Product',
                component: PageView,
                meta: { title: '产品管理', icon: 'hdd' },
                redirect: '/order/lists',
                children: [
                    {
                        path: '/product/category',
                        name: 'ProductCategory',
                        component: Vue.component( 'ProductCategory', require( '@/pages/product/category/Category.vue' ).default ),
                        meta: { title: '产品分类' },
                    }
                ]
            },
            {
                path: '/tools',
                name: 'Tools',
                component: PageView,
                meta: { title: '助手工具', icon: 'tool' },
                redirect: '/order/lists',
                children: [
                    {
                        path: '/employee/lists',
                        name: 'EmployeeLists',
                        component: Vue.component( 'EmployeeLists', require( '@/pages/employee/Lists.vue' ).default ),
                        meta: { title: '员工管理' },
                    }
                ]
            }
        ]
    }
]


export const constantRouterMap = [
    {
        path: '/user',
        redirect: '/user/login',
        hidden: true,
        component: UserLayout,
        children: [
            {
                path: '/user/login',
                name: 'login',
                component: Vue.component( 'Login', require( '@/pages/user/Login.vue' ).default ),
            }
        ]
    }
]