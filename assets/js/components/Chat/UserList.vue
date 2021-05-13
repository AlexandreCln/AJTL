<template>
  <div class="user-list">
    <Header class="header">
      <svg-icon
        class="minimize"
        icon="minus"
        @click="$emit('toggleChat')"
      />
    </Header>
    <div class="list">
      <UserItem
        v-for="user in users"
        :key="user.id"
        :user="user"
        @click="$emit('switchTab', 'Conversation', user)"
      />
    </div>
  </div>
</template>

<script>
import SvgIcon from '@/components/common/SvgIcon'
import Header from '@/components/Chat/Header'
import UserItem from '@/components/Chat/UserItem';
import chatApi from '@/composables/chatApi.js';

export default {
  name: 'UserList',
  components: { Header, SvgIcon, UserItem },
  setup () {
    const users = chatApi.getUserList()

    return {
      users : users
    }
  },
}
</script>

<style lang="scss" scoped>
$listBgColor: linen;
$headerHeight: 42px;

.user-list {
  .header {
    height: $headerHeight;
    .minimize {
      justify-self: end;
    }
  }
  .list {
    height: calc(100% - #{$headerHeight});
    overflow-x: hidden;
    overflow-y: scroll;   
    background-color: $listBgColor;
  }
}
</style>