<template>
  <div class="user-item">
    <Avatar :photo-src="user.photoSrc" />
    <div class="info">
      <strong>{{ user.name }}</strong>
      <span v-if="user.online">En ligne</span>
      <span v-else>Hors ligne</span>
    </div>
    <svg
      height="10"
      width="27"
    >
      <circle
        cx="5"
        cy="5"
        r="5"
        :fill="user.online ? 'mediumseagreen' : 'gray'"
      />
    </svg>
  </div>
</template>

<script>
import Avatar from '@/components/Chat/Avatar'

export default {
  name: 'UserItem',
  components: { Avatar },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  setup (props) { // props is reactive
    return {  }
  }
}
</script>

<style lang="scss" scoped>
$itemHeight: 50px;
$itemBgColor: aliceblue;

.user-item {
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