<template>
  <div class="medical-container observation">
    <div class="medical-container-header">
      <h2>Notas</h2>

      <router-link v-if="observation && isOwner" :to="{name: 'ObservationForm', params: {pet_id: pet_id}}">Editar</router-link>
    </div>

    <Placeholder
        v-if="!observation && isOwner"
        :img_src="placeholder.img_src"
        :text="placeholder.text"
        :path_name="placeholder.cta.path_name"
        :cta_text="placeholder.cta.text"
        :pet_name="pet_name"
        :pet_id="pet_id"
    />

    <p v-else-if="!observation && !isOwner">Esta mascota no tiene nota.</p>

    <div v-else class="medical-container-body">
      <p>{{ observation }}</p>
    </div>
  </div>
</template>

<script>
import Placeholder from "@/components/pet/show/detail/medical/PetDetailMedicalPlaceholder";
import store from "@/store";

export default {
  name: "PetDetailMedicalObservation",
  components: {
    Placeholder,
  },
  props: {
    observation: {
      type: String,
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
  data() {
    return {
      store,
    }
  },
  computed: {
    isOwner() {
      return !this.store.user.is_professional;
    }
  }
}
</script>
