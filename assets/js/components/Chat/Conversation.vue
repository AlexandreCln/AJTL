<template>
  <div class="conversation">
    <Header class="header">
      <SvgIcon
        class="back"
        icon="left-arrow"
        @click="$emit('switchTab', 'ContactList')"
      />
    </Header>
    <div class="messages-area">
      <Message
        v-for="message in messages"
        :key="message.id"
        :message="message"
      />
    </div>
    <form>
      <div class="input-area">
        <textarea
          v-model="inputValue"
          placeholder="Message ..."
          @keydown.enter.prevent="sendMessage"
        />
        <SvgIcon
          class="send"
          icon="send"
          @click="sendMessage"
        />
      </div>
    </form>
  </div>
</template>

<script>
import Message from '@/components/Chat/Message';
import SvgIcon from '@/components/common/SvgIcon';

export default {
  name: 'Conversation',
  components: { Message, SvgIcon },
  props: { 
    user: {
      type: Object,
      required: true
    }
  },
  setup (props) {
    const messages = [
      {text: 'Salut !'},
      {text: 'Salut !'},
    ];

    return { messages }
  },
  data() {
    return {
      inputValue: ''
    }
  },
  methods: {
    sendMessage() {
      console.log(this.inputValue)
      this.inputValue = ''
    } 
  }
}
</script>

<style lang="scss" scoped>
@import 'Styles/helpers/_colors.scss';
$headerHeight: 42px;

.conversation {
  display: grid;
  grid-template-rows: $headerHeight 1fr auto;
  height: 100%;
  width: 100%;
  background-color: white;
  .header {
    height: $headerHeight;
  }
  .input-area {
    display: grid;
    grid-template-columns: 85% 1fr;
    background-color: $primary;
    border-top: 1px solid $borderLight;
    cursor: pointer;
    textarea {
      height: 60px;
      max-height: 155px;
      font-size: 14px;
      border: none;
      padding: 9px;
    }
    .send {
      margin: auto;
      color: white;
    }
  }
}
</style>