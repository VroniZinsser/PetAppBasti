<template>
  <v-container fluid>

    <Loader v-if="loading"></Loader>

    <div v-else>
      <h1>Peticiones creadas</h1>

      <v-btn @click="dialog = true">Crear petición</v-btn>

      <List :shared-pets="sharedPets"></List>

      <v-dialog v-model="dialog" max-width="700" class="container--fluid">
        <v-card>
          <h2>Crear petición</h2>

          <Form :pets="userPets"/>

          <v-btn
              elevation="2"
              large
              outlined
              @click="dialog = false"
          >Cancelar</v-btn>
        </v-card>
      </v-dialog>
    </div>
  </v-container>
</template>

<script>
import contactService from "../../services/contact";
import List from "../../components/contacts/requests/List";
import Loader from "../../components/general/notifications/Loader";
import Form from "../../components/contacts/requests/create/Form";
import petServices from "../../services/pets";

export default {
  name: "Inbox",
  components: {Form, Loader, List},
  data: () => ({
    loading: true,
    sharedPets: null,
    dialog: false,
    userPets: [],
  }),
  mounted() {
    contactService.getOwnerSharedPets()
        .then(res => {
          this.sharedPets = res.data.sharedPets;
        });

    petServices.getOwnerPets()
        .then(res => {
          this.userPets = res.data.pets;
          this.loading = false;
        });

    /*
    contactService.getProfessionalSharedPets()
        .then(res => {
          console.warn("Peticiones del profesional: ");
          console.log(res.data);
        });



    contactService.update(this.formData, 1)
        .then(res => {
          console.warn("Peticiones modificada: ");
          console.log(res.data);
        });

    contactService.accept(6)
        .then(res => {
          console.warn("Peticiones aceptada: ");
          console.log(res.data);
        })

    contactService.delete(7)
        .then(res => {
          console.warn("Peticiones Eliminada: ");
          console.log(res);
        })*/
  }
}
</script>

<style scoped>

</style>
