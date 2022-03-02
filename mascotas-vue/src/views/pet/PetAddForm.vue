<template>
  <TheLoader v-if="loading"/>

  <BaseFormContainer
      headline="Agregar una nueva mascota"
      form_class="form-pet"
      :is_short_form="false"
      v-else
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