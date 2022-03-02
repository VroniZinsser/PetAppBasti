<template>
  <v-card class="profile-card">
    <v-avatar size="75px">
      <v-img :src="createImgPath(user.profile_image.src)"/>
    </v-avatar>

    <div>
      <v-card-title>
        {{ nameToDisplay(user) }}
      </v-card-title>
    </div>
  </v-card>
</template>

<script>
import {createImgPath, nameToDisplay} from "@/helpers";

export default {
  name: "ProfessionalProfileCard",
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      createImgPath,
      nameToDisplay,
    }
  }
}
</script>
