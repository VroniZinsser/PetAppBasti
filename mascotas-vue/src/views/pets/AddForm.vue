<template>
  <v-container fluid>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />
    <h1>Agregar mascota</h1>

    <p v-if="loading">Cargando...</p>

    <Form v-else
          :sexes="sexes"
          :species="species"
    ></Form>
  </v-container>
</template>

<script>
import Form from "../../components/pets/add/Form";
import petServices from "../../services/pets";
import BaseNotification from "@/components/general/notifications/BaseNotification";
import store from "@/store";

export default {
  name: "CreateForm",
  components: {
    Form,
    BaseNotification,  
  },
  data: () => ({
    loading: true,
    sexes: [],
    species: [],
    store,
  }),
  mounted() {
    petServices.addForm()
        .then(res => {
          this.sexes = res.data.sexes;
          this.species = res.data.species;
        });

    this.loading = false;
  }
}
</script>

<style scoped>

</style>
