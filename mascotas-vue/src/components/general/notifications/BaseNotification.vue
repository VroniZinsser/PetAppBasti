<template>
  <v-alert
      :type="type"
      class="alert"
  >
    <h3 v-if="title != null"
    >{{ title }}</h3>
    {{ text }}
  </v-alert>
</template>

<script>
export default {
  name: 'BaseNotification',
  props: {
    text: {
      type: String,
      required: true
    },
    type: {
      type: String,
      default: 'info'
    },
    title: {
      type: String
    },
    closable: {
      type: Boolean,
      default: false
    }
  },
}
</script>

<style scoped>

</style>
