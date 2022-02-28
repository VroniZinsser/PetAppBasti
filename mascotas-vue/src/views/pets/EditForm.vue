<template>
  <Loader v-if="loading"></Loader>
  <FormContainer
      headline="Editar mascota"
      form_class="form-pet-edit"
      :is_short_form="false"
      v-else
  >
    <Form v-if="pet"
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
import { handleAccessError } from "@/helpers";
import store from "@/store";

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
    pet: null,
    handleAccessError,
    store,
  }),
  mounted() {
    petServices.createForm()
        .then(res => {
          this.sexes = res.data.sexes;
          this.species = res.data.species;
        });

    petServices.find(this.$route.params.pet_id)
        .then(res => {
          if (res.data) {
            this.pet = res.data.pet;
          } else {
            if (this.handleAccessError(res)) return;
            this.store.setStatus({
              msg: "No se encontró la mascota solicitada.",
              type: 'Error'
            });
            this.$router.push({name: 'Pets'});
          }
          this.loading = false;
        })
  }
}
</script>

<style scoped>

</style>
