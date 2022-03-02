<template>
    <v-list-item @click="$emit('onclick')">
        <v-list-item-icon v-if="icon">
            <v-icon>{{ icon }}</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
            <v-list-item-title>{{ text }}</v-list-item-title>
        </v-list-item-content>
    </v-list-item>
</template>

<script>
export default {
  name: "SettingsDialogItem",

  props: {
      icon: {
          type: String,
      },
      text: {
          type: String,
          required: true,
      },
  }
}
</script>