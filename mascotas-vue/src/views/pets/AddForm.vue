<template>
  <Loader v-if="loading"></Loader>
  <FormContainer
    headline="Agregar una nueva mascota"
    form_class="form-pet"
    :is_short_form="false"
    v-else
  >
    <Form
          :sexes="sexes"
          :species="species"
    ></Form>
  </FormContainer>
</template>

<script>
import Form from "../../components/pets/Form";
import FormContainer from "../../components/general/forms/FormContainer";
import petServices from "../../services/pets";
import Loader from "../../components/general/notifications/Loader";

export default {
  name: "CreateForm",
  components: {
    Loader,
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
          this.loading = false;
        });
  }
}
</script>

<style scoped>

</style>
