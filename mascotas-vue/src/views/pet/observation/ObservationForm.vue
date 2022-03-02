<template>
  <TheLoader v-if="loading"></TheLoader>

  <BaseFormContainer
      headline="¿Hay algo que te llamó la atención?"
      form_class="form-observation"
      :is_short_form="true"
      v-else
  >
    <p>Tu espacio libre para anotar observaciones acerca del comportamiento o la salud de tu mascota.</p>

    <ObservationForm :pet_id="$route.params.pet_id" :observation="observation"></ObservationForm>
  </BaseFormContainer>
</template>

<script>
import ObservationForm from "@/components/pet/observation/ObservationForm";
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import petServices from "@/services/pets";
import TheLoader from "@/components/general/layout/TheLoader";
import { handleAccessError } from "@/helpers";

export default {
  name: "ObservationForm",
  components: {
    TheLoader,
    ObservationForm,
    BaseFormContainer,
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
