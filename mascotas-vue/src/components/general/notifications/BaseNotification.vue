<template>
  <v-alert
      :type="type"
      class="alert"
      dense
      text
      :color="notificationColor[type]"
      :dismissible="closable"
  >
    <p v-if="title != null"
    >{{ title }}</p>
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
      default: true
    }
  },
  data: () => ({ 
    notificationColor: {
      success: '#3fb094',
      info: '#3FA7D6',
      warning: '#d7ac38',
      danger: '#BA3B46',
    }
  })
}
</script>

<style scoped>

</style>
