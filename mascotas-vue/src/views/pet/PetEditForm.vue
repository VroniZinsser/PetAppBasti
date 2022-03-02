<template>
  <TheLoader v-if="loading"></TheLoader>
  <BaseFormContainer
      headline="Editar mascota"
      form_class="form-pet-edit"
      :is_short_form="false"
      v-else
  >
    <PetForm v-if="pet"
          :sexes="sexes"
          :species="species"
          :pet="pet"
    ></PetForm>
  </BaseFormContainer>
</template>

<script>
import PetForm from "@/components/pet/PetForm";
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import TheLoader from "@/components/general/layout/TheLoader";
import petServices from "../../services/pets";
import { handleAccessError } from "@/helpers";
import store from "@/store";

export default {
  name: "PetEditForm",
  components: {
    TheLoader,
    PetForm,
    BaseFormContainer,
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
