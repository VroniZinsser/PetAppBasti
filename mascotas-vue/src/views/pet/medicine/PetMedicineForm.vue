<template>
  <BaseFormContainer
      :headline="headline"
      :is_short_form="false"
      form_class="form-medicine"
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
import {handleAuthenticationError} from "@/helpers";

export default {
  name: "PetMedicineForm",
  components: {
    MedicineForm,
    BaseFormContainer,
  },
  data: function () {
    return {
      loading: true,
      hours: [],
      medicine: null,
      handleAuthenticationError,
    }
  },
  computed: {
    headline(){
      return this.$route.params.medicine_id ? 'Editar medicamento' : 'Agregá un nuevo medicamento'
    }
  },
  mounted() {
    if (this.$route.params.medicine_id) {
      medicineServices.updateForm(this.$route.params.medicine_id)
          .then(res => {
            if (this.handleAuthenticationError(res)) return;

            this.medicine = res.data.medicine;

            this.hours = res.data.hours;

            this.loading = false;
          })
    } else {
      medicineServices.createForm()
          .then(res => {
            if (this.handleAuthenticationError(res)) return;

            this.hours = res.data.hours;

            this.loading = false;
          })
    }
  }
}
</script>
