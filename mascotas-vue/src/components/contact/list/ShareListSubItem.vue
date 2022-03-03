<template>
  <v-expansion-panel>
    <WarnDialog
        :showDialog="showWarnDialog"
        :dialogTitle="dialogTitle"
        :dialogText="dialogText"
        :acceptButtonText="dialogButtonText"
        @cancel="showWarnDialog = false"
        @accept="deleteRequest"
    />

    <v-expansion-panel-header>
      
      <div class="shared-pet-overview">
        <router-link v-if="!professionalName" :to="{name: 'PetShared', params: {'pet_id': pet.id}}">
          <img :src="createImgPath(pet.image.src)" :alt="pet.image.alt"/>
        </router-link>
        
        <img v-else :src="createImgPath(pet.image.src)" :alt="pet.image.alt"/>

        <div class="pet-container">
          <router-link v-if="!professionalName" :to="{name: 'PetShared', params: {'pet_id': pet.id}}">
            <p class="pet-name">{{ petName }}</p>
          </router-link>

          <p v-else class="pet-name">{{ petName }}</p>
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

        {{ buttonText }}
      </button>
    </v-expansion-panel-content>
  </v-expansion-panel>
</template>

<script>
import WarnDialog from "@/components/general/notification/BaseDialogWarn";
import {createImgPath} from "@/helpers";
import {formatDate} from "@/helpers";

export default {
  name: "ShareListSubItem",
  components: {
    WarnDialog,
  },
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

    owner() {
      return this.request.owner;
    },

    petName() {
      return this.professionalName ? this.pet.name : `${this.pet.name} - ${this.owner.first_name} ${this.owner.last_name}`;
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
      return this.professionalName ? `Tu mensaje a ${this.professionalName}: ` : 'Mensaje: '
    },

    dialogTitle() {
      return this.professionalName ? `¿Dejar de compartir a ${this.pet.name}?` : `¿Dejar de ver a ${this.pet.name}?`
    },

    dialogText() {
      return this.professionalName ? `${this.professionalName} no podrá ver más el perfil de ${this.pet.name}. Podés volver a compartir la mascota cuando quieras.` : `No podrás ver más el perfil de ${this.pet.name} hasta que el dueño te la vuelva a compartir.`
    },

    dialogButtonText() {
      return this.professionalName ? `Dejar de compartir` : `Dejar de ver`
    },

    buttonText(){
      return this.professionalName ? 'Dejar de compartir' : 'Dejar de ver';
    }
  },
  methods: {
    deleteRequest() {
      this.professionalName ? this.$parent.$parent.$emit('delete-request', this.request.id) : this.$parent.$parent.$parent.$emit('delete-request', this.request.id)
      this.showWarnDialog = false;
    }
  },
};
</script>
