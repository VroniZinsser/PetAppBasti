<template>
  <v-alert
      :type="type"
      class="alert"
      dense
      text
      :color="notificationColor[type]"
      :dismissible="closable"
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
      default: true
    }
  },
  data: () => ({ 
    notificationColor: {
      success: '#28a745',
      info: '#17a2b8',
      warning: '#ffc107',
      danger: '#D64550',
    }
  })
}
</script>

<style scoped>

</style>
