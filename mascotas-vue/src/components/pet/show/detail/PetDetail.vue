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
      <PetProfile :pet="pet" @deleted="$emit('deleted')"></PetProfile>
    </div>
  </div>
</template>

<script>
import PetProfile from "@/components/pet/show/detail/PetDetailProfile";
import PetMedicalInfo from "@/components/pet/show/detail/medical/PetDetailMedical";
import {createImgPath} from "@/helpers";

export default {
  name: "PetDetail",
  components: {
    PetProfile,
    PetMedicalInfo,
  },
  props: {
    pet: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      tab: null,
      activeItem: 'pet-medical-info',
      createImgPath,
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
