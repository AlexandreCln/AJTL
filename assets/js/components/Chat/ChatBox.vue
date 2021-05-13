<template>
  <div
    v-if="isOpen"
    class="chat-container"
  >
    <SvgSprite />
   
    <keep-alive>
      <component
        :is="currentTab"
        class="current-tab"
        :user="user"
        @switchTab="switchTab"
        @toggleChat="toggleChat"
      />
    </keep-alive>
  </div>

  <button
    v-else
    class="open-chat-btn"
    @click="toggleChat"
  >
    <i class="fas fa-2x fa-comment-dots" />
  </button>
</template>

<script>
import SvgSprite from '@/components/common/SvgSprite'
import SvgIcon from '@/components/common/SvgIcon'
import UserList from "@/components/Chat/UserList";
import Conversation  from "@/components/Chat/Conversation";

export default {
  name: 'ChatBox',
  components: { SvgSprite, SvgIcon, UserList, Conversation },
  data() {
    return {
      isOpen: true,
      currentTab: 'UserList',

      user: null,
    };
  },
  methods: {
    toggleChat() { 
      this.isOpen = !this.isOpen 
    },
    switchTab(tab, user) {
      this.currentTab = tab
      this.user = user
    }
  }
}
</script>

<style lang="scss">
@import "Styles/helpers/_colors.scss";

.chat-container {
  position: fixed;
  bottom: 50px;
  right: 50px;
  .current-tab {
    width: 240px;
    height: 350px;
    overflow: hidden;
    border-radius: 8px 8px 0 0;
    border: 1px solid $borderLight;
  }
}
.open-chat-btn {
  position: fixed;
  right: 50px;
  bottom: 50px;
  background-color: $primary;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  border: none;
  &:hover {
    background-color: darken($primary, 7%);
    transition: background-color .5s ease-out;
  }
}

/* Chrome Scrollbars */
  *::-webkit-scrollbar {
    width: 5px;
  }
  *::-webkit-scrollbar-track {
    background: #ddd;
  }
  *::-webkit-scrollbar-thumb {
    background: #666; 
  }
</style>