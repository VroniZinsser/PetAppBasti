<template>
  <FormContainer
      v-if="!loading"
      :headline="this.$route.params.vaccine_id ? 'Editar vacuna' : 'Agregar una nueva vacuna'"
      form_class="form-vaccine"
      :is_short_form="true"
  >
    <p>No olvides de anotar el nombre exacto de la vacuna para poder reconocerla después.</p>

    <Form
        :pet_id="this.$route.params.pet_id"
        :vaccine="vaccine"
    ></Form>
  </FormContainer>
</template>

<script>
import Form from "../../components/pets/vaccine/Form";
import FormContainer from "../../components/general/forms/FormContainer";
import vaccineService from "@/services/vaccines";
import { handleAccessError } from "@/helpers";

export default {
  name: "VaccineForm",
  components: {
    Form,
    FormContainer,
  },
  data() {
    return {
      loading: true,
      vaccine: null,
      handleAccessError,
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
