<template>
  <BaseFormContainer
    headline="Ingresar"
    form_class="form-login"
    :is_short_form="true"
  >
    <LoginForm/>
    <div class="register">
      <p>¿Todavía no tenés una cuenta? <router-link :to="{name: 'OwnerSignUp'}">Registrarme</router-link></p>
    </div>
  </BaseFormContainer>
</template>

<script>
import LoginForm from "@/components/auth/login/LoginForm";
import BaseFormContainer from "@/components/general/form/BaseFormContainer";

export default {
  name: "Login",
  components: {
    LoginForm,
    BaseFormContainer,
  },
  data: () => ({
    loading: true,
    user_types: [],
  }),
}
</script>

<style scoped>

</style>
