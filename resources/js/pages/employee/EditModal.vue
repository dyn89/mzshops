<template>
    <a-modal
        :title="id !== '' ? '用户修改' : '用户新建'"
        :visible="visible"
        :confirm-loading="confirmLoading"
        :width="800"
        destroyOnClose
        cancelText="取消"
        okText="确认"
        @ok="handleOk"
        @cancel="handleCancel"
    >
        <a-form :form="form">
            <a-form-item v-bind="formItemLayout" label="姓名">
                <a-input
                    v-decorator="[
                    'em_name',
                    {
                        rules: [
                            {
                                required: true,
                                message: '请输入姓名',
                            },
                        ],
                    },
                    ]"
                />
            </a-form-item>
            <a-form-item v-bind="formItemLayout" label="性别">
                <a-select
                    v-decorator="[
                    'em_gender',
                    {
                        initialValue: 0,
                        rules: [
                            { 
                                required: true, 
                                message: '请选择性别' 
                            }
                        ]
                    },
                    ]"
                >
                    <a-select-option :value="1">
                        男
                    </a-select-option>
                    <a-select-option :value="2">
                        女
                    </a-select-option>
                    <a-select-option :value="0">
                        保密
                    </a-select-option>
                </a-select>
            </a-form-item>
            <a-form-item v-bind="formItemLayout" label="出生日期">
                <a-date-picker
                    v-decorator="[
                    'em_birth',
                    {
                        rules: [
                            {
                                type: 'object',
                                required: true,
                                message: '请输入出生日期'
                            }
                        ],
                    }
                    ]" />
            </a-form-item>
            <a-form-item v-bind="formItemLayout" label="邮箱">
                <a-input
                    v-decorator="[
                    'em_email',
                    {
                        rules: [
                            {
                                type: 'email',
                                message: '邮箱格式无效',
                            },
                            {
                                required: true,
                                message: '请输入邮箱',
                            },
                        ],
                    },
                    ]"
                />
            </a-form-item>
            <a-form-item v-bind="formItemLayout" label="手机号">
                <a-input
                    v-decorator="[
                    'em_phone',
                    {
                        rules: [{ required: true, message: '请输入手机号' }],
                    },
                    ]"
                    style="width: 100%"
                >
                </a-input>
            </a-form-item>
            <a-form-item v-bind="formItemLayout" label="密码">
                <a-input
                    v-decorator="[
                    'em_password',
                    {
                        rules: [
                            {
                                required: true,
                                message: '请输入密码',
                            },
                        ],
                    },
                    ]"
                    type="password"
                />
            </a-form-item>
            <a-form-item v-bind="formItemLayout" label="状态">
                <a-radio-group
                    v-decorator="[
                        'em_status',
                        {
                            initialValue: 1,
                            rules: [
                            {
                                required: true,
                                message: '请选择状态',
                            },
                        ],
                        }
                    ]">
                        <a-radio :value="1">
                            正常
                        </a-radio>
                        <a-radio :value="0">
                            禁用
                        </a-radio>
                </a-radio-group>
            </a-form-item>
            <a-form-item v-bind="formItemLayout" label="个人简介">
                <a-textarea
                    :auto-size="{ minRows: 3, maxRows: 5 }"
                    v-decorator="['em_summary']"
                />
            </a-form-item>
        </a-form>
    </a-modal>
</template>

<script>
import { patchEmployee } from '@/api/employee'
export default {
    name: "EditModal",
    data() {
        return {
            confirmLoading: false,
            formItemLayout: {
                labelCol: {
                    span: 6
                },
                wrapperCol: {
                    span: 16
                },
            },
        };
    },
    props: {
        visible: {
            type: Boolean,
            default: false
        },
        id: {
            type: String,
            default: ''
        }
    },
    beforeCreate() {
        this.form = this.$form.createForm(this, { name: 'employeeForm' });
    },
    methods: {
        // 确认
        handleOk(e) {
            this.form.validateFields((err, values) => {
                if (!err) {
                    values.em_birth = values.em_birth.format('YYYY-MM-DD')
                    this.confirmLoading = true;
                    patchEmployee(values)
                        .then((res) => {
                            this.$emit('closeModal', true)
                        })
                        .finally(() => {
                            this.confirmLoading = false
                        })
                }
            })
        },
        // 关闭弹窗
        handleCancel(e) {
            this.$emit('closeModal', false)
        },
    }
}
</script>

<style scoped>

</style>