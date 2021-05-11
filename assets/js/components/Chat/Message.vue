<template>
  <div>
    {{ message.text }}
  </div>
</template>

<script>
export default {
  props: {
    message: {
      type: Object,
      required: true
    }
  },
  setup (props) {

    return { }
  }
}
</script>

<style lang="scss" scoped>

</style>