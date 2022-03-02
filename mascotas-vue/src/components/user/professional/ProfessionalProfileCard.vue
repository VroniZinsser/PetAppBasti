<template>
  <v-card class="profile-card">
    <v-avatar  size="75px">
        <v-img :src="createImgPath(user.profile_image.src)"></v-img>
    </v-avatar>
    <div>
        <v-card-title>
            {{ nameToDisplay(user) }}
        </v-card-title>
    </div>
</v-card>
</template>
<script>
import {createImgPath} from "@/helpers";
import {nameToDisplay} from "@/helpers";

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
