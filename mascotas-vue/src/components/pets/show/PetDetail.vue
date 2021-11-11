<template>
    <div>
      <div class="img-container">
        <img :src="getCompletePath(pet.image.src)" :alt="pet.image.alt">
      </div>
      <div class="gender-icon-container">
        <span class="material-icons">{{ getGenderIcon(pet.sexes_id) }}</span>
      </div>
      <div>
        <v-tabs
          v-model="tab"
          align-with-title
        >
          <v-tabs-slider color="yellow"></v-tabs-slider>

          <v-tab>Detalles</v-tab>
          <v-tab>Perfil</v-tab>
        </v-tabs>
        <v-tabs-items v-model="tab">
          <v-tab-item key="medical-details" >
            <h3>Detalles</h3>
          </v-tab-item>
          <v-tab-item key="profile" >
            <h3>Perfil</h3>
          </v-tab-item>
        </v-tabs-items>
      </div>
    </div>
</template>
<script>

import {PATH_IMG} from "../../../constants";

export default {
  name: "PetDetail",
  props: {
    pet: {
      type: Object,
      required: true
    },
  },
  data() {
    return {
      tab: null,
    }
  },
   methods: {
    getCompletePath(path) {
      return PATH_IMG + path
    },
    getGenderIcon(sexes_id) {
      return sexes_id === 1 ? "gender_female" : "gender_male";
    }
  }
}

</script>
