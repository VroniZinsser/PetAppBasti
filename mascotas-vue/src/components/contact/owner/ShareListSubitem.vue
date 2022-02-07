<template>
  <v-expansion-panel>
    <v-expansion-panel-header>
      <div>
        <img :src="createImgPath(pet.image.src)" :alt="pet.image.alt" />
        <div class="pet-container">
          <p>{{ pet.name }}</p>
          <p class="light-text">{{ expirationText }}</p>
        </div>
      </div>
    </v-expansion-panel-header>
    <v-expansion-panel-content>
      <div v-if="request.description" class="quote-container">
        <p class="light-text">Vos escribiste:</p>
        <p class="light-text quote">"{{ request.description }}"</p>
      </div>
      <button>
        <v-icon> mdi-link-variant-off </v-icon>
        Dejar de compartir
      </button>
    </v-expansion-panel-content>
  </v-expansion-panel>
</template>

<script>
import { createImgPath } from "@/helpers";
import { formatDate } from "@/helpers";

export default {
  name: "ShareListSubitem",
  props: {
    request: {
      type: Object,
      required: true,
    },
  },
  computed: {
    pet() {
      return this.request.pet;
    },
    /**
     * Builds a sentence about expiration with formatted date, based on the pet's sex
     */
    expirationText() {
      let text = this.pet.sexes_id === 1 ? "Compartida" : "Compartido";
      text += " hasta el " + this.formatDate(this.request.expiration_date);
      return text;
    },
  },
  data() {
    return {
      createImgPath,
      formatDate,
    };
  },
};
</script>

<style scoped>
</style>
