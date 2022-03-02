<template>
  <div class="medical-container vaccine">
    <div class="medical-container-header">
      <h2>Vacunas</h2>
      <router-link v-if="vaccines.length > 0" :to="{name: 'VaccineList', params: {pet_id: pet_id}}">Ver más
      </router-link>
    </div>

    <Placeholder
        v-if="vaccines.length === 0"
        :img_src="placeholder.img_src"
        :text="placeholder.text"
        :path_name="placeholder.cta.path_name"
        :cta_text="placeholder.cta.text"
        :pet_name="pet_name"
        :pet_id="pet_id">
    </Placeholder>

    <div v-else class="medical-container-body">
      <VaccineItem
          v-for="vaccine in vaccines"
          :key="vaccine.id"
          :vaccine="vaccine">
      </VaccineItem>
    </div>
  </div>
</template>
<script>

import VaccineItem from "@/components/pet/show/detail/medical/PetDetailMedicalVaccineItem";
import Placeholder from "@/components/pet/show/detail/medical/PetDetailMedicalPlaceholder";

export default {
  name: "PetDetailMedicalVaccine",
  props: {
    vaccines: {
      type: Array,
      required: true
    },
    placeholder: {
      type: Object,
      required: true,
    },
    pet_name: {
      type: String,
      required: true,
    },
    pet_id: {
      type: Number,
      required: true,
    }
  },
  components: {
    Placeholder,
    VaccineItem
  },
}
</script>
