<template>
  <div class="contact-item">
    <Avatar :photo-src="contact.avatarFilename" />
    <div class="info">
      <strong>{{ contact.username }}</strong>
      <!-- <span v-if="contact.online">En ligne</span> -->
      <!-- <span v-else>Hors ligne</span> -->
    </div>
    <svg
      height="10"
      width="27"
    >
      <!-- <circle
        cx="5"
        cy="5"
        r="5"
        :fill="contact.online ? 'mediumseagreen' : 'gray'"
      /> -->
    </svg>
  </div>
</template>

<script>
import Avatar from '@/components/Chat/Avatar'

export default {
  name: 'ContactItem',
  components: { Avatar },
  props: {
    contact: {
      type: Object,
      required: true
    }
  },
  setup (props) { // props est reactive, mais si on destructure les valeurs ne le sont plus (doit utiliser toRefs() )
    return {  }
  }
}
</script>

<style lang="scss" scoped>
$itemHeight: 50px;
$itemBgColor: aliceblue;

.contact-item {
  display: flex;
  align-items: center;
  background-color: $itemBgColor;
  cursor: pointer;
  font-size: 15px;
  height: $itemHeight;
  border-bottom: 1px solid silver;
  &:hover {
    background-color: lighten($itemBgColor, 10%);
  }
  img {
    height: $itemHeight - 5px;
    width: $itemHeight - 5px;
    padding: 5px;
  }
  .info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
    width: 100%;
    padding: 0 5px;
    overflow-x: hidden;
    line-height: 1.2;
    strong {
      text-overflow: ellipsis;
      white-space: nowrap;
      overflow-x: hidden;
    }
    span {
      font-size: 12px;
      white-space: nowrap;
    }
  }
  svg {
    padding: 0 5px;
  }
}
</style>