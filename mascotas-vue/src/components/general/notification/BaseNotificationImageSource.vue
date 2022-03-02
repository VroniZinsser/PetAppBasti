<template>
  <v-alert
      v-if="show"
      dense
      text
      color="#858585"
      class="image-source-notification"
  >
    <slot/>
  </v-alert>
</template>

<script>
export default {
  name: "BaseNotificationImageSource",
  props: {
    show: {
      type: Boolean,
      required: true,
      default: false,
    }
  }
}
</script>