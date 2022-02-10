<template>
  <v-expansion-panel>
    <v-expansion-panel-header>
      <div>
        <img :src="createImgPath(pet.image.src)" :alt="pet.image.alt" />
        <div class="pet-container">
          <p class="pet-name">{{ pet.name }}</p>
          <p class="expiration">{{ expirationText }}</p>
        </div>
      </div>
    </v-expansion-panel-header>
    <v-expansion-panel-content>
      <div v-if="request.description" class="quote-container">
        <p class="quote-intro">Tu mensaje a {{professionalName}}:</p>
        <p class="quote">"{{ request.description }}"</p>
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
    professionalName: {
      type: String,
      required: true
    }
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
