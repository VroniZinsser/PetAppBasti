<template>
  <div class="medical-container observation">
    <div class="medical-container-header">
      <h2>Notas</h2>
       <router-link v-if="observation" :to="{name: 'ObservationForm'}">Ver más</router-link>
    </div>

    <Placeholder
        v-if="!observation"
        :img_src="placeholder.img_src"
        :text="placeholder.text"
        :path_name="placeholder.cta.path_name"
        :cta_text="placeholder.cta.text"
        :pet_name="pet_name"
        :pet_id="pet_id">
    </Placeholder>

    <div v-else class="medical-container-body">
      <p>{{ observation }}</p>
    </div>
  </div>
</template>

<script>
import Placeholder from "@/components/pets/show/medical/Placeholder";

export default {
  name: "Observation",
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
  components: {
    Placeholder,
  },
}
</script>
