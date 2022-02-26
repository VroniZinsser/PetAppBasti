<template>
  <FormContainer
    headline="Registrarme"
    form_class="form-signup-owner"
    :is_short_form="false"
  >

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
