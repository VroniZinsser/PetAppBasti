<template>
  <BaseFormContainer
      v-if="!loading"
      :headline="headline"
      :is_short_form="true"
      form_class="form-vaccine"
  >
    <p>No olvides de anotar el nombre exacto de la vacuna para poder reconocerla después.</p>

    <VaccineForm
        :pet_id="this.$route.params.pet_id"
        :vaccine="vaccine"
    />
  </BaseFormContainer>
</template>

<script>
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import VaccineForm from "@/components/pet/vaccine/VaccineForm";
import vaccineService from "@/services/vaccines";
import {handleAccessError} from "@/helpers";

export default {
  name: "PetVaccineForm",
  components: {
    VaccineForm,
    BaseFormContainer,
  },
  data() {
    return {
      loading: true,
      vaccine: null,
      handleAccessError,
    }
  },
  computed: {
    headline() {
      return this.$route.params.medicine_id ? 'Editar vacuna' : 'Agregar una nueva vacuna'
    }
  },
  mounted() {
    if (this.$route.params.vaccine_id) {
      vaccineService.find(this.$route.params.vaccine_id)
          .then(res => {
            if (this.handleAccessError(res)) return;

            this.vaccine = res.data.vaccine;

            this.loading = false;
          })
    } else {
      this.loading = false;
    }
  },
}
</script>
