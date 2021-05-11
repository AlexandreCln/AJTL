<template>
  <div class="list">
    <UserItem
      v-for="user in users"
      :key="user.id"
      :user="user"
      @click="$emit('switchTab', 'Conversation', user)"
    />
  </div>
</template>

<script>
import UserItem from '@/components/Chat/UserItem';
import chatApi from '@/composables/chatApi.js';

export default {
  name: 'UserList',
  components: { UserItem },
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

.list {
  height: 100%;
  background-color: $listBgColor;
  overflow-x: hidden;
  overflow-y: scroll;   
}
</style>