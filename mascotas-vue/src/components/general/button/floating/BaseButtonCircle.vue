<template>
  <button class="float-circle-btn" @click="$emit('active')">
    <span class="material-icons">{{ this.icon ? this.icon : 'add' }}</span>
    <span class="sr-only">{{ this.text ? this.text : 'Agregar (Abre listado de enlaces)' }}</span>
  </button>
</template>

<script>
export default {
  name: "BaseButtonCircle",
  props: {
    icon: {
      type: String
    },
    text: {
      type: String
    }
  }
}
</script>

<style scoped>

</style>
