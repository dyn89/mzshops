<template>
    <a-card>
        <a-spin :spinning="spinning">
            <a-button type="dashed" icon="plus" block @click="addOrEdit()">
                新建
            </a-button>

            <a-table
                :columns="columns"
                :data-source="data"
            >
                <div slot="cate_img" slot-scope="text">
                    <img v-if="text" width="50" height="50" :src="text"/>
                </div>
                <div slot="cate_status" slot-scope="text, record">
                    <a-switch
                        checked-children="上架"
                        un-checked-children="下架"
                        :checked="text === 1"
                        @change="(bool, event) => switchChange(bool, event, record.key)"
                    />
                </div>
            </a-table>
        </a-spin>
        <edit-modal v-if="visible" :visible="visible" :id="employeeId" @closeModal="closeModal"></edit-modal>
    </a-card>
</template>

<script>
import { mapGetters } from 'vuex'
import EditModal from './EditModal'
import { getCateList, categoryUpDown } from '@/api/product'
const columns = [
    {
        title: '分类名',
        width: '25%',
        dataIndex: 'title',
        key: 'title',
    },
    {
        title: '图片',
        dataIndex: 'img',
        key: 'img',
        scopedSlots: { customRender: 'cate_img' },
    },
    {
        title: '是否上架',
        width: '10%',
        dataIndex: 'status',
        key: 'status',
        scopedSlots: { customRender: 'cate_status' },
    }
];
export default {
    name: "Lists",
    components: {
        EditModal
    },
    data() {
        return {
            data: [],
            columns,
            visible: false,
            employeeId: '',
            spinning: false
        };
    },
    computed: {
        ...mapGetters([
            'nickname',
        ]),
    },
    methods: {
        // 弹窗
        addOrEdit (id = '') {
            this.employeeId = id
            this.visible = !this.visible
        },
        // 关闭弹窗
        closeModal (v) {
            this.visible = false
            if (v) {
                this.fetchCateList()
            }
        },
        // 员工列表
        fetchCateList () {
            this.spinning = true
            getCateList()
                .then((res) => {
                    this.data = res.data
                })
                .finally(() => {
                    this.spinning = false
                })
        },
        // 产品分类上架下架
        switchChange (bool, event, id) {
            this.spinning = true
            const param = { id: id, user: this.nickname, status: bool }
            console.log(id)
            categoryUpDown(param)
                .then((res) => {
                    this.$notification.success({
                        message: 'Success',
                        description: '操作成功'
                    });
                    this.fetchEmployee()
                })
                .finally(() => {
                    this.spinning = false
                })
        }

    },
    created() {
        this.fetchCateList()
    }
}
</script>

<style scoped>
.ant-delete-link {
    color: red;
}
</style>