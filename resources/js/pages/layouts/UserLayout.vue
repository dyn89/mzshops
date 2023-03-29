<template>
    <div id="userLayout" class="user-layout-wrapper">
        <div class="container">
            
            <vue-particles color="#dedede"></vue-particles>
            <router-view></router-view>

            <div class="footer">
                <div class="links">
                    <!-- <a href="_self">帮助</a> -->
                </div>
                <div class="copyright">
                    Copyright &copy; 2023
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'UserLayout',
        data () {
            return {}
        },
        mounted () {
            document.body.classList.add('userLayout')
        },
        beforeDestroy () {
            document.body.classList.remove('userLayout')
        }
    }
</script>

<style lang="scss" scoped>
    #userLayout.user-layout-wrapper {
        height: 100%;

        .container {
            width: 100%;
            min-height: 100%;
            background: #f0f2f5 url(~@/assets/sky.871d198.jpg) no-repeat 50%;
            background-size: cover;
            position: relative;

            a {
                text-decoration: none;
            }

            .top {
                text-align: center;

                .header {
                    height: 44px;
                    line-height: 44px;

                    .badge {
                        position: absolute;
                        display: inline-block;
                        line-height: 1;
                        vertical-align: middle;
                        margin-left: -12px;
                        margin-top: -10px;
                        opacity: 0.8;
                    }

                    .logo {
                        height: 66px;
                        vertical-align: top;
                        margin-right: 16px;
                        border-style: none;
                    }

                    .title {
                        font-size: 33px;
                        color: rgba(0, 0, 0, .85);
                        font-family: Avenir, 'Helvetica Neue', Arial, Helvetica, sans-serif;
                        font-weight: 600;
                        position: relative;
                        top: 2px;
                    }
                }
                .desc {
                    font-size: 14px;
                    color: rgba(0, 0, 0, 0.45);
                    margin-top: 12px;
                    margin-bottom: 40px;
                }
            }

            .main {
                padding: 50px;
                background-color: rgb(251 255 255 / 60%);
                border-radius: 10px;
                min-width: 260px;
                width: 368px;
                height: 374px;
                position: absolute;
                left: 0;
                right: 0;
                top: 0;
                bottom: 0;
                margin: auto;
            }

            .footer {
                position: absolute;
                width: 100%;
                bottom: 0;
                padding: 0 16px;
                margin: 48px 0 24px;
                text-align: center;

                .links {
                    margin-bottom: 8px;
                    font-size: 14px;
                    a {
                        color: rgba(0, 0, 0, 0.45);
                        transition: all 0.3s;
                        &:not(:last-child) {
                            margin-right: 40px;
                        }
                    }
                }
                .copyright {
                    color: darkgray;
                    font-size: 14px;
                }
            }
        }
    }
</style>
