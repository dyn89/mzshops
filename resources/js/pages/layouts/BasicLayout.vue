<template>
    <a-layout id="components-layout-demo-custom-trigger">
        <a-layout-sider v-model="collapsed" :trigger="null" collapsible>
            <div class="head-logo">
                <img :class="!collapsed ? 'img-logo' : 'img-min-logo'" src="@/assets/logo.jpg" />
            </div>
            <a-menu
                theme="dark"
                mode="inline"
                :open-keys="openKeys"
                @openChange="onOpenChange"
            >
                <template v-for="menu in menus">
                    <template v-if="menu.children !== undefined && menu.children.length > 0">
                        <a-sub-menu :key="menu.name">
                            <span slot="title">
                                <a-icon v-if="menu.meta.icon" :type="menu.meta.icon" />
                                <span>{{ menu.meta.title }}</span>
                            </span>

                            <a-menu-item v-for="little in menu.children" @click="menuClick(little.path)" :key="little.name">
                                <a-icon v-if="little.meta.icon" :type="little.meta.icon" />
                                <span>{{ little.meta.title }}</span>
                            </a-menu-item>

                        </a-sub-menu>
                    </template>
                    <template v-else>
                        <a-menu-item @click="menuClick(menu.path)" :key="menu.name">
                            <a-icon v-if="menu.meta.icon" :type="menu.meta.icon" />
                            <span>{{ menu.meta.title }}</span>
                        </a-menu-item>
                    </template>
                </template>
            </a-menu>
        </a-layout-sider>
        <a-layout>
            <a-layout-header style="background: #fff; padding: 0">
                <a-icon
                    class="trigger"
                    :type="collapsed ? 'menu-unfold' : 'menu-fold'"
                    @click="() => (collapsed = !collapsed)"
                />
                <right-content/>
            </a-layout-header>
            <a-layout-content
                :style="{ height: '100%', margin: '2px 1px 0', paddingTop: '0' }"
            >
                <transition name="page-transition">
                    <router-view />
                </transition>
            </a-layout-content>
            <a-layout-footer style="textAlign: center">明珠商城 © 2023</a-layout-footer>
        </a-layout>
    </a-layout>
</template>

<script>
import { asyncRouterMap } from '@/config/router.config.js'
import RightContent from '@/components/GlobalHeader/RightContent'

export default {
    name: "BasicLayout",
    data() {
        return {
            collapsed: false,
            menus: [],
            openKeys: [],
        }
    },
    components: {
        RightContent
    },
    methods: {
        menuClick (path) {
            const currentPath = this.$router.currentRoute.path
            if (currentPath !== path) {
                this.$router.push(path)
            }
        },
        onOpenChange (openKeys) {
            if (openKeys.length > 0) {
                this.openKeys = [ openKeys.pop() ]
            } else {
                this.openKeys = []
            }
        }
    },
    created () {
        this.menus = asyncRouterMap.find((item) => item.path === '/').children
        console.log(this.menus)
    },
}
</script>

<style>
#components-layout-demo-custom-trigger {
    height: 100%;
}
#components-layout-demo-custom-trigger .trigger {
    font-size: 18px;
    line-height: 64px;
    padding: 0 24px;
    cursor: pointer;
    transition: color 0.3s;
}

#components-layout-demo-custom-trigger .trigger:hover {
    color: #1890ff;
}

#components-layout-demo-custom-trigger .head-logo {
    text-align: center;
    padding: 15px;
}

.img-logo {
    width: 80px;
    border-radius: 50px;
    margin-right: 21px;
}
.img-min-logo {
    width: 46px;
    border-radius: 24px;
    margin-right: 21px;
}
</style>