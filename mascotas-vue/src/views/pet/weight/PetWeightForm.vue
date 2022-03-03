<template>
  <BaseFormContainer
      :headline="headline"
      :is_short_form="true"
      form_class="form-weight"
  >
    <p>Si pesás a tu mascota regularmente será mucho más fácil llevar un control sobre su dieta.</p>

    <WeightForm
        v-if="!loading"
        :pet_id="$route.params.pet_id"
        :weight="weight"
    />
  </BaseFormContainer>
</template>

<script>
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import WeightForm from "@/components/pet/weight/WeightForm";
import weightService from "@/services/weights";
import {handleAccessError, handleAuthenticationError} from "@/helpers";

export default {
  name: "PetWeightForm",
  components: {
    WeightForm,
    BaseFormContainer
  },
  data() {
    return {
      loading: true,
      weight: null,
      handleAccessError,
      handleAuthenticationError,
    }
  },
  computed: {
    headline() {
      return this.$route.params.medicine_id ? 'Editar peso' : '¿Cuánto pesa tu mascota?'
    }
  },
  mounted() {
    if (this.$route.params.weight_id) {
      weightService.find(this.$route.params.weight_id)
          .then(res => {
            if (this.handleAuthenticationError(res)) return;
            if (this.handleAccessError(res)) return;

            this.weight = res.data.weight;

            this.loading = false;
          })
    } else {
      this.loading = false;
    }
  }
}
</script>
