<template>
    <a-modal
        :title="id !== '' ? '产品分类修改' : '产品分类新建'"
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
            <a-form-item
                v-bind="formItemLayout"
                label="所属分类"
            >
                <a-tree-select
                    v-decorator="[
                        'cate_bid',
                        {
                            rules: [
                                {
                                    required: true,
                                    message: '请选择分类',
                                },
                            ],
                        },
                    ]"
                    style="width: 100%"
                    :dropdown-style="{ maxHeight: '400px', overflow: 'auto' }"
                    :tree-data="treeData"
                    tree-default-expand-all
                >
                </a-tree-select>
            </a-form-item>
            <a-form-item v-bind="formItemLayout" label="分类名称">
                <a-input
                    v-decorator="[
                    'cate_name',
                    {
                        rules: [
                            {
                                required: true,
                                message: '请输入分类名',
                            },
                        ],
                    },
                    ]"
                />
            </a-form-item>
            <a-form-item
                v-bind="formItemLayout"
                label="图片"
            >
                <a-upload
                    :multiple="false"
                    :beforeUpload="beforeUploadFun"
                    v-decorator="[
                    'cate_img',
                    {
                        rules: [
                            {
                                message: '请选择图片',
                            },
                        ],
                    },
                    ]"
                    list-type="picture"
                >
                    <a-button> <a-icon type="upload" /> 上传图片 </a-button>
                </a-upload>
            </a-form-item>
            <a-form-item v-bind="formItemLayout" label="状态">
                <a-radio-group
                    v-decorator="[
                        'cate_status',
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
        </a-form>
    </a-modal>
</template>

<script>
import { createCate, getCateList } from '@/api/product'
import FormData from 'form-data'
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
            treeData: [],
            parentCate: ''
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
        this.form = this.$form.createForm(this, { name: 'cateForm' });
    },
    methods: {
        // 确认
        handleOk(e) {
            this.form.validateFields((err, values) => {
                if (!err) {
                    console.log(values)
                    this.confirmLoading = true
                    const formData = new FormData()
                    formData.append('cate_bid', values.cate_bid)
                    formData.append('cate_name', values.cate_name)
                    formData.append('cate_status', values.cate_status)
                    formData.append('cate_bid', values.cate_bid)
                    if (values.cate_img !== undefined) {
                        formData.append('cate_img', values.cate_img.file)
                    }
                    createCate(formData)
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
        // 手动图片上传
        beforeUploadFun () {
            return false
        },
        // 获取产品分类列表
        fetchProductCate () {
            getCateList()
                .then((res) => {
                    this.treeData = res.data
                })
        }

    },
    created () {
        this.fetchProductCate()
    }
}
</script>

<style scoped>

</style>