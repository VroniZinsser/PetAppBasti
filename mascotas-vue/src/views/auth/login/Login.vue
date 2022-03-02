<template>
  <BaseFormContainer
      :is_short_form="true"
      headline="Ingresar"
      form_class="form-login"
  >
    <LoginForm/>

    <div class="register">
      <p>¿Todavía no tenés una cuenta?
        <router-link :to="{name: 'OwnerSignUp'}">Registrarme</router-link>
      </p>
    </div>
  </BaseFormContainer>
</template>

<script>
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import LoginForm from "@/components/auth/login/LoginForm";

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
