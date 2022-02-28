<template>
  <FormContainer
      :headline="this.$route.params.weight_id ? 'Editar peso' : '¿Cuánto pesa tu mascota?'"
      form_class="form-weight"
      :is_short_form="true"
  >
    <p>Si pesás a tu mascota regularmente será mucho más fácil llevar un control sobre su dieta.</p>

    <Form
        v-if="!loading"
        :pet_id="$route.params.pet_id"
        :weight="weight"
    ></Form>
  </FormContainer>
</template>

<script>
import Form from "../../components/pets/weight/Form";
import FormContainer from "../../components/general/forms/FormContainer";
import weightService from "@/services/weights";
import { handleAccessError } from "@/helpers";

export default {
  name: "WeightForm",
  components: {
    Form,
    FormContainer
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
