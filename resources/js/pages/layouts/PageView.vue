<template>
    <div>
        <page-header></page-header>
        <div class="content">
            <div class="page-header-index-wide">
                <slot>
                    <router-view ref="content"></router-view>
                </slot>
            </div>
        </div>
    </div>
</template>

<script>
    import PageHeader from '@/components/PageHeader'

    export default {
        name: "PageView",
        components: {
            PageHeader
        },
        data() {
            return {
            };
        },
    }
</script>

<style scoped>
    .content {
        margin: 24px;
    }

</style>