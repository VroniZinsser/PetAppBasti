<template>
  <BaseFormContainer
      :headline="this.$route.params.weight_id ? 'Editar peso' : '¿Cuánto pesa tu mascota?'"
      form_class="form-weight"
      :is_short_form="true"
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
import {handleAccessError} from "@/helpers";

export default {
  name: "WeightForm",
  components: {
    WeightForm,
    BaseFormContainer
  },
  data() {
    return {
      loading: true,
      weight: null,
      handleAccessError,
    }
  },
  mounted() {
    if (this.$route.params.weight_id) {
      weightService.find(this.$route.params.weight_id)
          .then(res => {
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
