<template>
  <FormContainer
      :headline="this.$route.params.medicine_id ? 'Editar medicamento' : 'Agregá un nuevo medicamento'"
      form_class="form-medicine"
      :is_short_form="false"
  >
    <p>Podés agregar medicamentos actuales pero también medicamentos del pasado para tener un registro.</p>

    <Form
        v-if="!loading"
        :hours="hours"
        :pet_id="$route.params.pet_id"
        :medicine="medicine"
    >
    </Form>
  </FormContainer>
</template>

<script>

import Form from '@/components/pets/medicines/Form';
import medicineServices from "@/services/medicines";
import FormContainer from "@/components/general/forms/FormContainer";

export default {
  name: "MedicineForm",
  components: {
    Form,
    FormContainer,
  },
  data: function () {
    return {
      loading: true,
      hours: [],
      medicine: null,
    }
  },
  mounted() {
    if (this.$route.params.medicine_id) {
      medicineServices.updateForm(this.$route.params.medicine_id)
          .then(res => {
            this.medicine = res.data.medicine;
            this.hours = res.data.hours;
            this.loading = false;
          })
    } else {
      medicineServices.createForm()
          .then(res => {
            this.hours = res.data.hours;
            this.loading = false;
          })
    }
  }
}
</script>

<style scoped>

</style>
