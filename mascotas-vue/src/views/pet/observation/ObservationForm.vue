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
import Form from "@/components/pet/observation/ObservationForm";
import FormContainer from "@/components/general/form/BaseFormContainer";
import petServices from "@/services/pets";
import Loader from "@/components/general/layout/TheLoader";
import { handleAccessError } from "@/helpers";

export default {
  name: "ObservationForm",
  components: {
    Loader,
    Form,
    FormContainer,
  },
  data: () => ({
    loading: true,
    observation: null,
    handleAccessError,
  }),
  mounted() {
    petServices.getObservation(this.$route.params.pet_id)
        .then(res => {
          if (this.handleAccessError(res)) return;
          this.loading = false
          if (res.success) {
            this.observation = res.data.observation;
          }
        })
  }
}
</script>
