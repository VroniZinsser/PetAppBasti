<template>
  <FormContainer
    headline="Agregar una nueva mascota"
    form_class="form-pet"
    :is_short_form="false"
  >

    <p v-if="loading">Cargando...</p>

    <Form v-else
          :sexes="sexes"
          :species="species"
    ></Form>
  </FormContainer>
</template>

<script>
import Form from "../../components/pets/add/Form";
import FormContainer from "../../components/general/forms/FormContainer";
import petServices from "../../services/pets";

export default {
  name: "CreateForm",
  components: {
    Form,
    FormContainer,
  },
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
