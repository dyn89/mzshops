<template>
  <div class="ant-pro-global-header-index-right">
    <avatar-dropdown :menu="showMenu" :current-user="currentUser" :class="prefixCls" />
  </div>
</template>

<script>
import AvatarDropdown from './AvatarDropdown'
import { mapGetters } from 'vuex'
export default {
  name: 'RightContent',
  components: {
    AvatarDropdown,
  },
  props: {
    prefixCls: {
      type: String,
      default: 'ant-pro-global-header-index-action'
    },
  },
  computed: {
    ...mapGetters([
      'nickname',
    ]),
  },
  data () {
    return {
      showMenu: true,
      currentUser: {
        name: 'Serati Ma'
      }
    }
  },
  created () {
    this.$set(this.currentUser, 'name', this.nickname)
  }
}
</script>
<style scoped>
.ant-pro-global-header-index-right {
    float: right;
    height: 100%;
    margin-left: auto;
    overflow: hidden;
    margin-right: 30px;
}
</style>