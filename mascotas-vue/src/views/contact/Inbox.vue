<template>
  <v-container class="text-center pt-16">

    <v-btn @click="FormDialog = true">Crear petición</v-btn>

    <v-dialog v-model="FormDialog" max-width="500">
      <v-card>
        <v-card-title class="text-h5 grey lighten-2 light-blue lighten-2">
          Crear una nueva petición
        </v-card-title>

        <Form
            v-if="pets"
            :pets="pets"
            v-on:request-created="createShareLink"
        />

        <v-card-text v-else class="pt-4 text-center">Necesitas tener como mínimo una mascota registrada</v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
              color="red"
              text
              @click="FormDialog = false"
          >
            {{ pets ? 'Cancelar' : 'Cerrar' }}
          </v-btn>

          <v-spacer></v-spacer>
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

        <div class="d-flex justify-space-around">
          <p class="clipboard-input">{{ requestLink }}</p>
          <v-btn @click="copyLink">Copiar</v-btn>
        </div>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="shareDialog = false">Cerrar</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import Form from "@/components/contact/requests/Form";
import petServices from "@/services/pets";
import BaseNotification from "@/components/general/notifications/BaseNotification";

export default {
  name: "Inbox",
  components: {
    BaseNotification,
    Form
  },
  data: () => ({
    FormDialog: false,
    shareDialog: false,
    pets: null,
    notification: {
      text: null,
      type: 'success',
    },
    requestLink: null,
  }),
  methods: {
    createShareLink(request) {
      this.FormDialog = false;

      this.notification.text = "Éxito. Ya puedes compartir la mascota con el enlace de abajo";
      this.notification.type = "success";

      this.requestLink = this.createLink(request.id);

      this.shareDialog = true;
    },

    createLink(id) {
      return `http://127.0.0.1:8080/#/peticiones/${id}/aceptar`
    },

    copyLink() {
      navigator.clipboard.writeText(this.requestLink);

      this.notification.text = "El enlace se copió en el portapapeles";
      this.notification.type = "info";
    },
  },
  mounted() {
    petServices.getOwnerPets()
        .then(res => {
          if (res.success) {
            this.pets = res.data.pets;
          }
        })
  }
}
</script>
