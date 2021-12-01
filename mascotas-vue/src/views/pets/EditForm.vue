<template>
  <FormContainer
    headline="Editar mascota"
    form_class="form-pet-edit"
    :is_short_form="false"
  >

    <Loader v-if="loading"></Loader>

    <Form v-else
          :sexes="sexes"
          :species="species"
          :pet="pet"
    ></Form>
  </FormContainer>
</template>

<script>
import Form from "../../components/pets/Form";
import FormContainer from "../../components/general/forms/FormContainer";
import Loader from "../../components/general/notifications/Loader";
import petServices from "../../services/pets";

export default {
  name: "EditForm",
  components: {
    Loader, 
    Form,
    FormContainer,
  },
  data: () => ({
    loading: true,
    sexes: [],
    species: [],
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
