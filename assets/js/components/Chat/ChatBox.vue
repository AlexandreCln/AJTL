<template>
  <div
    v-if="isOpen"
    class="chat-container"
  >
    <SvgSprite />
    <div class="header">
      <svg-icon
        v-if="currentTab == 'Conversation'"
        class="back"
        icon="left-arrow"
        @click="switchTab('UserList')"
      />
      <svg-icon
        v-if="currentTab == 'UserList'"
        class="minimize"
        icon="minus"
        @click="toggleChat"
      />
    </div>
   
    <keep-alive>
      <component
        :is="currentTab"
        class="current-tab"
        :user="user"
        @switchTab="switchTab"
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
};
</script>

<style lang="scss">
$chatColor: lightgray;
$headerHeight: 42px;

.chat-container {
  position: fixed;
  bottom: 50px;
  right: 50px;
  overflow: hidden;
  width: 220px;
  height: 350px;
  border-radius: 8px 8px 0 0;

  .header {
    display: grid;
    align-items: center;
    height: $headerHeight;
    overflow: hidden;
    background-color: $chatColor;
    border-radius: 8px 8px 0 0;
    .icon {
      cursor: pointer;
      height: 20px;
      margin: 10px;
    }
    .minimize {
      justify-self: end;
    }
  }
  .current-tab {
    height: calc(100% - #{$headerHeight});
  }
}
.open-chat-btn {
  position: fixed;
  right: 50px;
  bottom: 50px;
  background-color: $chatColor;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  border: none;
  &:hover {
    background-color: darken($chatColor, 7%);
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