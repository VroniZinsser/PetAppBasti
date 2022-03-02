<template>
  <div class="settings-dialog-header">
    <div>
      <v-avatar v-if="user && user.is_professional && user.profile_image" size="42px">
        <img
            :alt="user.name"
            :src="createImgPath(user.profile_image.src)"
        >
      </v-avatar>

      <div>
        <span>{{ userName }}</span>

        <span class="mail">{{ user.email }}</span>
      </div>
    </div>

    <v-btn icon @click="$emit('close')">
      <v-icon>mdi-close</v-icon>
    </v-btn>
  </div>
</template>

<script>
import {createImgPath} from "@/helpers";

export default {
  name: "SettingsDialogHeader",
  props: {
    user: {
      type: Object,
      required: true
    },
  },
  data() {
    return {
      createImgPath,
    }
  },
  computed: {
    userName() {
      return `${this.user.first_name} ${this.user.last_name}`
    }
  },
}
</script>