<template>
  <div class="header">
    <slot />
  </div>
</template>

<style lang="scss">
@import "Styles/helpers/_colors.scss";

.header {
  display: grid;
  align-items: center;
  background-color: $primary;
  background-image: linear-gradient(160deg, $primary 0%, $primary-dark 100%);
  .icon {
    cursor: pointer;
    height: 20px;
    margin: 10px;
    color: white;
  }
}
</style>