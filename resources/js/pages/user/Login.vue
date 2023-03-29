<template>
    <div class="main">
        <h2 class="top-title">明珠商城管理系统</h2>
        <a-form
            id="formLogin"
            class="user-layout-login"
            ref="formLogin"
            :form="form"
            @submit="handleSubmit"
        >
            <a-form-item>
                <a-input
                    size="large"
                    type="text"
                    placeholder="用户名"
                    v-decorator="[
                        'username',
                        {rules: [{ required: true, message: '请输入用户名' }], validateTrigger: 'change'}
                    ]"
                >
                    <a-icon slot="prefix" type="user" :style="{ color: 'rgba(0,0,0,.25)' }"/>
                </a-input>
            </a-form-item>

            <a-form-item>
                <a-input-password
                    size="large"
                    placeholder="密码"
                    v-decorator="[
                        'password',
                        {rules: [{ required: true, message: '请输入密码' }], validateTrigger: 'blur'}
                    ]"
                >
                    <a-icon slot="prefix" type="lock" :style="{ color: 'rgba(0,0,0,.25)' }"/>
                </a-input-password>
            </a-form-item>

            <a-form-item style="margin-top:24px">
                <a-button
                    size="large"
                    type="primary"
                    htmlType="submit"
                    class="login-button"
                    :loading="loginBtn"
                    :disabled="loginBtn"
                >登录</a-button>
            </a-form-item>

            <div class="user-login-other">
                <span>其他登录方式</span>
                <a>
                    <a-icon class="item-icon" type="alipay-circle"></a-icon>
                </a>
                <a>
                    <a-icon class="item-icon" type="taobao-circle"></a-icon>
                </a>
                <a>
                    <a-icon class="item-icon" type="weibo-circle"></a-icon>
                </a>
            </div>
        </a-form>
    </div>
</template>

<script>
import Vue from 'vue'
import { ACCESS_TOKEN } from '@/store/mutation-types'
import { timeFix } from '@/utils/util'
import { login } from '@/api/login'

export default {
    data () {
        return {
            loginBtn: false,
            form: this.$form.createForm(this),
        }
    },
    created () {

    },
    methods: {
        handleSubmit (e) {
            e.preventDefault()
            const {
                form: { validateFields },
            } = this

            const validateFieldsKey = ['username', 'password']

            validateFields(validateFieldsKey, { force: true }, (err, values) => {
                if (!err) {
                    this.loginBtn = true
                    login(values)
                        .then((res) => {
                            Vue.ls.set(ACCESS_TOKEN, res.token.token_type + ' ' + res.token.access_token, res.token.expires_in * 1000)
                            this.loginSuccess(res)
                        })
                        .catch(err => this.requestFailed(err))
                        .finally(() => {
                            this.loginBtn = false
                        })
                }
            })
        },
        loginSuccess (res) {
            if (this.$route.query.redirect) {
                this.$router.push({ path: this.$route.query.redirect })
            } else {
                this.$router.push({ name: 'Dashboard' })
            }
            // 延迟 1 秒显示欢迎信息
            setTimeout(() => {
                this.$notification.success({
                    message: '欢迎',
                    description: `${timeFix()}，欢迎回来`
                })
            }, 1000)
        },
        requestFailed (err) {
            console.log('requestFailed', err)
            this.$notification['error']({
                message: '错误',
                description: ((err.response || {}).data || {}).message || '请求出现错误，请稍后再试',
                duration: 4
            })
        }
    }
}
</script>

<style lang="scss" scoped>
    .user-layout-login {
        label {
            font-size: 14px;
        }

        .forge-password {
            font-size: 14px;
        }

        button.login-button {
            padding: 0 15px;
            font-size: 16px;
            height: 40px;
            width: 100%;
        }

        .user-login-other {
            text-align: left;
            margin-top: 24px;
            line-height: 22px;

            .item-icon {
                font-size: 24px;
                color: rgba(0, 0, 0, 0.2);
                margin-left: 16px;
                vertical-align: middle;
                cursor: pointer;
                transition: color 0.3s;

                &:hover {
                    color: #1890ff;
                }
            }

            .register {
                float: right;
            }
        }
    }
    .top-title {
        text-align: center;
        margin-bottom: 24px;
        font-weight: 400;
    }
</style>