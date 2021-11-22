<template>
  <div class="pet-detail">
    <div class="pet-image">
      <img :src="createImgPath(pet.image.src)" :alt="pet.image.alt">

      <div class="gender-icon-container">
        <span class="material-icons">{{ getGenderIcon(pet.sexes_id) }}</span>
      </div>
    </div>

    <div class="tab-button-container">
      <button
          class="tab"
          :class="{ 'active': isActive('pet-medical-info') }"
          @click="setActive('pet-medical-info')"
      >
        <span>Detalles</span>
      </button>

      <button
          class="tab"
          :class="{ 'active': isActive('pet-profile') }"
          @click="setActive('pet-profile')"
      >
        <span>Perfil</span>
      </button>
    </div>

    <div class="tab-item pet-medical-info" :class="{ 'show': isActive('pet-medical-info') }">
      <PetMedicalInfo :pet="pet"></PetMedicalInfo>
    </div>

    <div class="tab-item pet-profile" :class="{ 'show': isActive('pet-profile') }">
      <PetProfile :pet="pet"></PetProfile>
    </div>
  </div>
</template>
<script>

import {createImgPath} from "@/helpers";
import PetProfile from "@/components/pets/show/PetProfile";
import PetMedicalInfo from "@/components/pets/show/PetMedicalInfo";


export default {
  name: "PetDetail",
  props: {
    pet: {
      type: Object,
      required: true,
    },
  },
  components: {
    PetProfile,
    PetMedicalInfo,
  },
  data() {
    return {
      tab: null,
      activeItem: 'pet-medical-info',
      createImgPath: createImgPath,
    }
  },
  methods: {
    getGenderIcon(sex_id) {
      return sex_id === 1 ? "female" : "male";
    },

    isActive(tabItem) {
      return this.activeItem === tabItem;
    },

    setActive(tabItem) {
      this.activeItem = tabItem;
    }
  }
}

</script>
