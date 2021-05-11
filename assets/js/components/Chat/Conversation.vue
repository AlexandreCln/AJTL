<template>
  <div class="chat-box">
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
          placeholder="Écrivez ici ..."
          @keydown.enter.prevent="sendMessage"
        />
        <SendIcon @click="sendMessage" />
      </div>
    </form>
  </div>
</template>

<script>
import Message from '@/components/Chat/Message';
import SendIcon from '@/components/Chat/SendIcon';

export default {
  name: 'Conversation',
  components: { Message, SendIcon },
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
$conversationBg: rgb(253, 253, 146);

.chat-box {
  display: grid;
  align-items: end;
  grid-template-rows: 1fr auto;
  height: 100%;
  width: 100%;
  background-color: $conversationBg;
  .input-area {
    display: grid;
    grid-template-columns: 85% 1fr;
    textarea {
      height: 36px;
      max-height: 155px;
      height: 36px;
      font-size: 14px;
      border: 1px solid #cccccc;
      padding: 5px;
    }
    svg {
      align-self: center;
      margin: 7px;
    }
  }
}
</style>