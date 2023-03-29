<template>
    <a-card>
        <a-spin :spinning="spinning">
            <a-button type="dashed" icon="plus" block @click="addOrEdit()">
                新建
            </a-button>

            <a-table
                :columns="columns"
                :data-source="data"
                :rowKey="(record, index) => index"
            >
                <span slot="em_gender" slot-scope="text">
                    <a-tag v-if="text === 1" color="cyan">
                        男
                    </a-tag>
                    <a-tag v-else-if="text === 2" color="pink">
                        女
                    </a-tag>
                    <a-tag v-else color="red">
                        保密
                    </a-tag>
                </span>
                <div slot="em_status" slot-scope="text, record">
                    <a-switch
                        checked-children="在职"
                        un-checked-children="离职"
                        :checked="text === 1"
                        @change="(bool, event) => switchChange(bool, event, record.id)"
                    />
                </div>
                <span slot="action" slot-scope="text, record">
                    <a @click="resetPwd(record.id)">重置密码</a>
                </span>
            </a-table>
        </a-spin>
        <edit-modal :visible="visible" :id="employeeId" @closeModal="closeModal"></edit-modal>
    </a-card>
</template>

<script>
import { mapGetters } from 'vuex'
import EditModal from './EditModal'
import { 
    getEmployees,
    employeeDelApi,
    resetPwdApi
} from '@/api/employee'
const columns = [
    {
        title: '姓名',
        dataIndex: 'em_name',
        key: 'em_name',
    },
    {
        title: '性别',
        dataIndex: 'em_gender',
        key: 'em_gender',
        scopedSlots: { customRender: 'em_gender' },
    },
    {
        title: '出生日期',
        dataIndex: 'em_birth',
        key: 'em_birth',
    },
    {
        title: '邮箱',
        key: 'em_email',
        dataIndex: 'em_email',
    },
    {
        title: '手机号',
        dataIndex: 'em_phone',
        key: 'em_phone',
    },
    {
        title: '状态',
        dataIndex: 'em_status',
        key: 'em_status',
        scopedSlots: { customRender: 'em_status' },
    },
    {
        title: '创建日期',
        key: 'created_at',
        dataIndex: 'created_at',
    },
    {
        title: '操作',
        key: 'action',
        scopedSlots: { customRender: 'action' },
    },
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
                this.fetchEmployee()
            }
        },
        // 员工列表
        fetchEmployee () {
            this.spinning = true
            getEmployees()
                .then((res) => {
                    this.data = res.data
                })
                .finally(() => {
                    this.spinning = false
                })
        },
        // 删除
        employeeDel (id) {
            this.spinning = true
            const param = { id: id, user: this.nickname }
            employeeDelApi(param)
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
        },
        // 重置密码
        resetPwd (id) {
            const that = this
            var operator = this.nickname
            this.$confirm({
                title: '是否继续此操作?',
                onOk () {
                    that.spinning = true
                    const param = {
                        id: id,
                        user: operator,
                    }
                    resetPwdApi(param)
                        .then((res) => {
                            that.$notification.success({
                                message: 'Success',
                                description: '操作成功'
                            });
                        })
                        .finally(() => {
                            that.spinning = false
                        })
                    },
                onCancel () {
                    console.log('Cancel')
                    }
                })
        },
        // 离职/在职
        switchChange (bool, event, id) {
            this.spinning = true
            const param = { id: id, user: this.nickname, status: bool }
            employeeDelApi(param)
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
        this.fetchEmployee()
    }
}
</script>

<style scoped>
.ant-delete-link {
    color: red;
}
</style>