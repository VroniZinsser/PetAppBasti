<template>
  <BaseFormContainer
      :headline="this.$route.params.medicine_id ? 'Editar medicamento' : 'Agregá un nuevo medicamento'"
      form_class="form-medicine"
      :is_short_form="false"
  >
    <p>Podés agregar medicamentos actuales pero también medicamentos del pasado para tener un registro.</p>

    <MedicineForm
        v-if="!loading"
        :hours="hours"
        :pet_id="$route.params.pet_id"
        :medicine="medicine"
    />
  </BaseFormContainer>
</template>

<script>
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import MedicineForm from '@/components/pet/medicine/MedicineForm';
import medicineServices from "@/services/medicines";

export default {
  name: "MedicineForm",
  components: {
    MedicineForm,
    BaseFormContainer,
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
