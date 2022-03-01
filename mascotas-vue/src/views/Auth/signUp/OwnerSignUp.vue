<template>
  <FormContainer
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
      Si trabajás en el rubro veterinario podés <router-link :to="{name: 'UserCreate'}">registrarte como profesional</router-link>
    </v-alert>

    <OwnerForm/>

    <p>¿Ya tenés una cuenta? <router-link :to="{name: 'Login'}">Ingresar</router-link></p>
  </FormContainer>
</template>

<script>
import OwnerForm from "@/components/auth/signUp/OwnerForm";
import FormContainer from "@/components/general/forms/FormContainer";

export default {
  name: "OwnerSignUp",
  components: {
    OwnerForm,
    FormContainer,
  }
}
</script>

<style scoped>

</style>
