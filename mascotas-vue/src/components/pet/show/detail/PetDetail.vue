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
          :class="buttonDetailClass"
          @click="setActive('pet-medical-info')"
      >
        <span>Detalles</span>
      </button>

      <button
          :class="buttonProfileClass"
          @click="setActive('pet-profile')"
      >
        <span>Perfil</span>
      </button>
    </div>

    <div :class="containerDetailClass">
      <PetMedicalInfo 
        :pet="pet"
      />
    </div>

    <div :class="containerProfileClass">
      <PetProfile 
        :pet="pet"
        @deleted="$emit('deleted')"
      />
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
    }
  },
  data() {
    return {
      tab: null,
      activeItem: 'pet-medical-info',
      createImgPath,
    }
  },
  computed: {
    buttonDetailClass() {
      let btnClass = 'tab';

      if (this.isActive('pet-medical-info')) {
        btnClass += ' active'
      }

      return btnClass
    },

    buttonProfileClass() {
      let btnClass = 'tab';

      if (this.isActive('pet-profile')) {
        btnClass += ' active'
      }

      return btnClass
    },

    containerDetailClass() {
      let btnClass = 'tab-item pet-medical-info';

      if (this.isActive('pet-medical-info')) {
        btnClass += ' show'
      }

      return btnClass
    },

    containerProfileClass() {
      let btnClass = 'tab-item pet-profile';

      if (this.isActive('pet-profile')) {
        btnClass += ' show'
      }

      return btnClass
    },
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
