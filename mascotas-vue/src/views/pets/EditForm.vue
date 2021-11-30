<template>
  <v-container fluid>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <h1>Editar mascota</h1>

    <Loader v-if="loading"></Loader>

    <Form v-else
          :sexes="sexes"
          :species="species"
          :pet="pet"
    ></Form>
  </v-container>
</template>

<script>
import BaseNotification from "../../components/general/notifications/BaseNotification";
import Form from "../../components/pets/Form";
import Loader from "../../components/general/notifications/Loader";
import petServices from "../../services/pets";
import store from "@/store";

export default {
  name: "EditForm",
  components: {Loader, BaseNotification, Form},
  data: () => ({
    loading: true,
    sexes: [],
    species: [],
    store,
    pet: null
  }),

  mounted() {
    petServices.createForm()
        .then(res => {
          this.sexes = res.data.sexes;
          this.species = res.data.species;
        });

    petServices.find(this.$route.params.pet_id)
        .then(res => {
          this.pet = res.data.pet;
          this.loading = false;
        })
  }
}
</script>

<style scoped>

</style>
