<template>
  <TheLoader v-if="loading"/>

  <BaseFormContainer
      v-else
      :is_short_form="false"
      headline="Agregar una nueva mascota"
      form_class="form-pet"
  >
    <PetForm
        :sexes="sexes"
        :species="species"
    />
  </BaseFormContainer>
</template>

<script>
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import PetForm from "@/components/pet/PetForm";
import petServices from "@/services/pets";
import TheLoader from "@/components/general/layout/TheLoader";
import {handleAuthenticationError} from "@/helpers";

export default {
  name: "PetAddForm",
  components: {
    TheLoader,
    PetForm,
    BaseFormContainer,
  },
  data: () => ({
    loading: true,
    sexes: [],
    species: [],
    handleAuthenticationError,
  }),
  mounted() {
    petServices.createForm()
        .then(res => {
          if (this.handleAuthenticationError(res)) return;

          this.sexes = res.data.sexes;

          this.species = res.data.species;

          this.loading = false;
        });
  }
}
</script>