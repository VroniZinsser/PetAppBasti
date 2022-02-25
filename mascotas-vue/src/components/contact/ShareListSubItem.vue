<template>
  <v-expansion-panel>
    <WarnDialog
        :showDialog="showWarnDialog"
        :dialogTitle="dialogTitle"
        :dialogText="dialogText"
        :acceptButtonText="dialogButtonText"

        @cancel="showWarnDialog = false"
        @accept="$parent.$parent.$emit('delete-request', request.id)"
    />
    <v-expansion-panel-header>
      <div>
        <img :src="createImgPath(pet.image.src)" :alt="pet.image.alt"/>
        <div class="pet-container">
          <p class="pet-name">{{ pet.name }}</p>
          <p class="expiration">{{ expirationText }}</p>
        </div>
      </div>
    </v-expansion-panel-header>
    <v-expansion-panel-content>
      <div v-if="request.description" class="quote-container">
        <p class="quote-intro">{{ quoteIntro }}</p>
        <p class="quote">"{{ request.description }}"</p>
      </div>
      <button @click="showWarnDialog = true">
        <v-icon> mdi-link-variant-off</v-icon>
        {{ this.professionalName ? 'Dejar de compartir' : 'Dejar de ver' }}
      </button>
    </v-expansion-panel-content>
  </v-expansion-panel>
</template>

<script>
import {createImgPath} from "@/helpers";
import {formatDate} from "@/helpers";
import WarnDialog from "@/components/general/notifications/WarnDialog";


export default {
  name: "ShareListSubItem",
  props: {
    request: {
      type: Object,
      required: true,
    },
    professionalName: {
      type: String,
      default: null,
    }
  },
  components: {
    WarnDialog,
  },
  data() {
    return {
      createImgPath,
      formatDate,
      showWarnDialog: false,
    };
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

    quoteIntro() {
      return this.professionalName ? 'Tu mensaje a this.professionalName: ' : 'Mensaje: '
    },

    dialogTitle(){
      return this.professionalName ? `¿Dejar de compartir a ${this.pet.name}?` : `¿Dejar de ver a ${this.pet.name}?`
    },

    dialogText(){
      return this.professionalName ? `${this.professionalName} no podrá ver más el perfil de ${this.pet.name}. Podés volver a compartir la mascota cuando quieras.` : `no podrá ver más el perfil de ${this.pet.name} hasta que el dueño te la vuelva a compartir.`
    },

    dialogButtonText(){
      return this.professionalName ? `Dejar de compartir` : `Dejar de ver`
    },
  },
  mounted() {

  }
};
</script>

<style scoped>
</style>
