<template>
  <FormContainer
    headline="Ingresar"
    form_class="form-login"
    :is_short_form="true"
  >
    <Form/>
    <div class="register">
      <p>¿Todavía no tenés una cuenta? <router-link :to="{name: 'OwnerSignUp'}">Registrarme</router-link></p>
    </div>
  </FormContainer>
</template>

<script>
import Form from "@/components/auth/login/LoginForm";
import FormContainer from "@/components/general/form/BaseFormContainer";

export default {
  name: "Login",
  components: {
    Form,
    FormContainer,
  },
  data: () => ({
    loading: true,
    user_types: [],
  }),
}
</script>

<style scoped>

</style>
