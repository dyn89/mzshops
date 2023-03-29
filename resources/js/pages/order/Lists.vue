<template>
    <h2>Lists</h2>
</template>

<script>
import { getOrderLists } from '@/api/order'
export default {
    name: "Lists",
    methods: {
        fetchOrderLists () {
            console.log('fetchOrderLists')
            getOrderLists()
                .then((res) => {
                    console.log(res)
                })
        }
    },
    created() {
        this.fetchOrderLists()
    }
}
</script>

<style scoped>

</style>