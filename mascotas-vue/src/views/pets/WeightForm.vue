<template>
  <FormContainer
      :headline="editing ? 'Editar peso' : '¿Cuánto pesa tu mascota?'"
      form_class="form-weight"
      :is_short_form="true"
  >
    <p>Si pesás a tu mascota regularmente será mucho más fácil llevar un control sobre su dieta.</p>
    <Form
        v-if="!loading"
        :pet_id="$route.params.pet_id"
        :editing="editing"
        :weight_id="this.$route.params.weight_id"
    ></Form>
  </FormContainer>
</template>

<script>
import Form from "../../components/pets/weight/Form";
import FormContainer from "../../components/general/forms/FormContainer";

export default {
  name: "WeightForm",
  components: {
    Form,
    FormContainer
  },
  data() {
    return {
      loading: true,
      editing: false,
    }
  },
  mounted() {
    if (this.$route.params.weight_id) {
      this.editing = true;
      this.loading = false;
    }
  }
}
</script>
