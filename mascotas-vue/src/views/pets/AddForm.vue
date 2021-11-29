<template>
  <v-container fluid>
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

export default {
  name: "CreateForm",
  components: {Form},
  data: () => ({
    loading: true,
    sexes: [],
    species: [],
  }),
  mounted() {
    petServices.createForm()
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
