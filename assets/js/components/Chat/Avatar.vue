<template>
  <img
    class="avatar"
    :src="photoSrc"
  >
</template>

<script>
import placeholderPath from 'Images/avatar_placeholder.jpg';

export default {
  props: { photoSrc: { type: String, default: placeholderPath } }
}
</script>

<style scoped>
  img {
    object-fit: cover;
    border-radius: 50%;
  }
</style>