<template>
  <TheLoader v-if="loading"/>

  <BaseFormContainer
      v-else
      :is_short_form="true"
      headline="¿Hay algo que te llamó la atención?"
      form_class="form-observation"
  >
    <p>Tu espacio libre para anotar observaciones acerca del comportamiento o la salud de tu mascota.</p>

    <ObservationForm :pet_id="$route.params.pet_id" :observation="observation"/>
  </BaseFormContainer>
</template>

<script>
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import ObservationForm from "@/components/pet/observation/ObservationForm";
import petServices from "@/services/pets";
import TheLoader from "@/components/general/layout/TheLoader";
import {handleAccessError, handleAuthenticationError} from "@/helpers";

export default {
  name: "PetObservationForm",
  components: {
    TheLoader,
    ObservationForm,
    BaseFormContainer,
  },
  data: () => ({
    loading: true,
    observation: null,
    handleAccessError,
    handleAuthenticationError,
  }),
  mounted() {
    petServices.getObservation(this.$route.params.pet_id)
        .then(res => {
          this.loading = false

          if (!res.success) {
            if (this.handleAuthenticationError(res)) return;
            if (this.handleAccessError(res)) return;
          } else {
            this.observation = res.data.observation;
          }
        })
  }
}
</script>
