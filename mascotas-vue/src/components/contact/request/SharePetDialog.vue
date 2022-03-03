<template>
  <div>
    <v-dialog v-model="showDialog" max-width="500" @click:outside="$emit('closeDialog')">
      <v-card class="form-dialog-container">
        <v-card-title>Compartir tu mascota</v-card-title>

        <Form
            v-if="pets && pets.length > 0"
            :pets="pets"
            :professionalName="professionalName"
            :professionalId="professionalId"
            v-on:request-created="createShareLink"
        />

        <v-card-text v-else class="pt-4 text-center">Necesitas tener como mínimo una mascota registrada</v-card-text>

        <v-divider/>

        <v-card-actions>
          <v-spacer/>

          <v-btn
              color="red"
              text
              @click="$emit('closeDialog')"
          >
            {{ pets && pets.length > 0 ? 'Cancelar' : 'Cerrar' }}
          </v-btn>

          <v-spacer/>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="shareDialog" max-width="500">
      <v-card class="px-4 py-4">
        <BaseNotification
            v-if="notification.text"
            :text="notification.text"
            :type="notification.type"
            :closable="false"
        />

        <div class="d-flex justify-space-around flex-wrap mb-2">
          <p class="clipboard-input">{{ requestLink }}</p>

          <v-btn @click="copyLink">Copiar</v-btn>
        </div>

        <v-card-actions>
          <v-spacer/>

          <v-btn text @click="shareDialog = false">Cerrar</v-btn>

          <v-spacer/>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import BaseNotification from "@/components/general/notification/BaseNotification";
import Form from "@/components/contact/request/SharePetForm";
import petServices from "@/services/pets";
import {createRequestAcceptUrl} from "@/helpers";

export default {
  name: "SharePetDialog",
  components: {
    BaseNotification,
    Form
  },
  props: {
      showDialog: {
          type: Boolean,
          default: false,
      },
      professionalName: {
          type: String,
          required: true,
      },
      professionalId: {
          type: Number,
          required: true,
      }
  },
  data: () => ({
    shareDialog: false,
    pets: null,
    notification: {
      text: null,
      type: 'success',
    },
    requestLink: null,
  }),
  mounted() {
    petServices.getOwnerPets()
        .then(res => {
          if (res.success) {
            this.pets = res.data.pets;
          }
        })
  },
  methods: {
    createShareLink(request) {
      this.$emit('closeDialog')

      this.notification.text = "Éxito. Ya puedes compartir la mascota con el enlace de abajo";

      this.notification.type = "success";

      this.requestLink = createRequestAcceptUrl(request.id);

      this.shareDialog = true;
    },

    copyLink() {
      navigator.clipboard.writeText(this.requestLink);

      this.notification.text = "El enlace se copió en el portapapeles";

      this.notification.type = "info";
    },
  },
}
</script>
