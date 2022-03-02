<template>
  <BaseFormContainer
      headline="Registrarme"
      form_class="form-signup-owner"
      :is_short_form="false"
  >
    <v-alert
        class="register-alert"
        color="#17a2b8"
        colored-border
        border="left"
        elevation="1"
        icon="mdi-account-plus"
        prominent
    >
      Si trabajás en el rubro veterinario podés
      <router-link :to="{name: 'UserCreate'}">registrarte como profesional</router-link>
    </v-alert>

    <OwnerSignUpForm/>

    <p>
      ¿Ya tenés una cuenta?

      <router-link :to="{name: 'Login'}">Ingresar</router-link>
    </p>
  </BaseFormContainer>
</template>

<script>
import OwnerSignUpForm from "@/components/auth/signUp/OwnerSignUpForm";
import BaseFormContainer from "@/components/general/form/BaseFormContainer";

export default {
  name: "OwnerSignUp",
  components: {
    OwnerSignUpForm,
    BaseFormContainer,
  }
}
</script>
