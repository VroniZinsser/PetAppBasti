<template>
  <FormContainer
    headline="Agregá un nuevo medicamento"
    form_class="form-medicine"
    :is_short_form="false"
  >
    <p>Podés agregar medicamentos actuales pero también medicamentos del pasado para tener un registro.</p>
    <p v-if="loading">Cargando...</p>

    <Form v-else
          :hours="hours"
          :pet_id="$route.params.pet_id">
    </Form>
  </FormContainer>
</template>

<script>

import Form from '@/components/pets/medicines/Form';
import medicineServices from "@/services/medicines";
import FormContainer from "@/components/general/forms/FormContainer";

export default {
  name: "MedicinesAddForm",
  components: {
    Form,
    FormContainer,
  },
  data: function (){
    return {
      loading: true,
      hours: [],
    }
  },
  mounted() {
    medicineServices.createForm()
        .then(res => {
          this.hours = res.data.hours;
          this.loading = false;
        })
  }
}
</script>

<style scoped>

</style>
