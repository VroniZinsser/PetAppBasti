<template>
  <BaseFormContainer
      :is_short_form="false"
      headline="Registrarme"
      form_class="form-signup-owner"
  >
    <v-alert
        class="register-alert"
        color="#17a2b8"
        border="left"
        elevation="1"
        icon="mdi-account-plus"
        colored-border
        prominent
    >
      Si trabajás en el rubro veterinario podés
      <router-link :to="{name: 'UserCreate'}" class="default-link">registrarte como profesional</router-link>
    </v-alert>

    <OwnerSignUpForm/>

    <p>
      ¿Ya tenés una cuenta?

      <router-link :to="{name: 'Login'}" class="default-link">Ingresar</router-link>
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
