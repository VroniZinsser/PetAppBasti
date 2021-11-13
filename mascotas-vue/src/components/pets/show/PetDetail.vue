<template>
    <div class="pet-detail">
      <div class="pet-image">
        <div class="img-container">
          <img :src="getCompletePath(pet.image.src)" :alt="pet.image.alt">
        </div>
        <span class="material-icons gender-icon">{{ getGenderIcon(pet.sexes_id) }}</span>
        
      </div>
      
        <v-tabs
          v-model="tab"
          align-with-title
        >
          <v-tabs-slider color="yellow"></v-tabs-slider>

          <v-tab @click.prevent="setActive('pet-medical-info')">Detalles</v-tab>
          <v-tab @click.prevent="setActive('pet-profile')">Perfil</v-tab>
        </v-tabs>
          <div class="tab-item pet-medical-info" :class="{ 'show': isActive('pet-medical-info') }">
            <h3>Detalles</h3>
            <PetMedicalInfo :pet="pet"></PetMedicalInfo>
          </div>
          <div class="tab-item pet-profile" :class="{ 'show': isActive('pet-profile') }">
            <h3>Perfil</h3>
            <PetProfile :pet="pet"></PetProfile>
          </div>
      </div>
</template>
<script>

import {PATH_IMG} from "../../../constants";
import PetProfile from "@/components/pets/show/PetProfile";
import PetMedicalInfo from "@/components/pets/show/PetMedicalInfo";


export default {
  name: "PetDetail",
  props: {
    pet: {
      type: Object,
      required: true
    },
  },
  components: {
    PetProfile,
    PetMedicalInfo
  },
  data() {
    return {
      tab: null,
      activeItem: 'pet-medical-info'
    }
  },
   methods: {
    getCompletePath(path) {
      return PATH_IMG + path
    },
    getGenderIcon(sexes_id) {
      return sexes_id === 1 ? "gender_female" : "gender_male";
    },
    isActive (tabItem) {
      return this.activeItem === tabItem
    },
    setActive (tabItem) {
      this.activeItem = tabItem
    }
  }
}

</script>