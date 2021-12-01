<template>
  <FormContainer
    headline="Registrarme"
    form_class="form-signup-professional"
    :is_short_form="false"
  >
    <p v-if="loading">Cargando...</p>

    <Form
        v-else-if="this.$route.meta.role === 'professional'"
        :user_types="user_types">
    </Form>
  </FormContainer>

</template>

<script>

import Form from "@/components/users/create/professional/Form";
import FormContainer from "../../components/general/forms/FormContainer";
import userService from "@/services/users"

export default {
  name: "ProfessionalSingUp",
  components: {
    Form,
    FormContainer,
  },
  data: () => ({
    loading: true,
    user_types: [],
  }),
  mounted() {
    userService.createForm()
        .then(res => {
          this.user_types = res.data.user_types;
        })

    this.loading = false;
  }
}
</script>

<style scoped>

</style>
