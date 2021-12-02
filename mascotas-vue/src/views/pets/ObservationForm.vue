<template>
  <Loader v-if="loading"></Loader>

  <FormContainer
      headline="¿Hay algo que te llamó la atención?"
      form_class="form-observation"
      :is_short_form="true"
      v-else
  >
    <p>Tu espacio libre para anotar observaciones acerca del comportamiento o la salud de tu mascota.</p>

    <Form :pet_id="$route.params.pet_id" :observation="observation"></Form>
  </FormContainer>
</template>

<script>
import Form from "../../components/pets/observation/Form";
import FormContainer from "../../components/general/forms/FormContainer";
import petServices from "../../services/pets";
import Loader from "../../components/general/notifications/Loader";

export default {
  name: "ObservationForm",
  components: {
    Loader,
    Form,
    FormContainer
  },
  data: () => ({
    loading: true,
    observation: null
  }),
  mounted() {
    petServices.getObservation(this.$route.params.pet_id)
        .then(res => {
          this.loading = false
          if (res.success) {
            console.log("entre")
            this.observation = res.data.observation;
          }
        })
  }
}
</script>
