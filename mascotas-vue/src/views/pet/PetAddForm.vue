<template>
  <TheLoader v-if="loading"></TheLoader>
  <BaseFormContainer
    headline="Agregar una nueva mascota"
    form_class="form-pet"
    :is_short_form="false"
    v-else
  >
    <PetForm
          :sexes="sexes"
          :species="species"
    ></PetForm>
  </BaseFormContainer>
</template>

<script>
import PetForm from "@/components/pet/PetForm";
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import petServices from "../../services/pets";
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

<style scoped>

</style>
