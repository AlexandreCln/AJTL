<template>
  <div class="contact-list">
    <Header class="header">
      <svg-icon
        class="minimize"
        icon="minus"
        @click="$emit('toggleChat')"
      />
    </Header>
    <div class="list">
      <ContactItem
        v-for="contact in contacts"
        :key="contact.id"
        :contact="contact"
        @click="$emit('switchTab', 'Conversation')"
      />
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import chatApi from '@/composables/chatApi.js';
import SvgIcon from '@/components/common/SvgIcon'
import Header from '@/components/Chat/Header'
import ContactItem from '@/components/Chat/ContactItem';

export default {
  name: 'ContactList',
  components: { Header, SvgIcon, ContactItem },
  setup () {
    const contacts = ref({});
    
    chatApi.fetchContacts()
      .then(res => contacts.value = res);

    return { contacts }
  },
}
</script>

<style lang="scss" scoped>
$listBgColor: linen;
$headerHeight: 42px;

.contact-list {
  .header {
    height: $headerHeight;
    .minimize {
      justify-self: end;
    }
  }
  .list {
    height: calc(100% - #{$headerHeight});
    overflow-x: hidden;
    overflow-y: auto;   
    background-color: $listBgColor;
  }
}
</style>