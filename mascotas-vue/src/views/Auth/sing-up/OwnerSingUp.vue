<template>
  <v-container fluid>
    <h1>Registrarme</h1>

    <OwnerForm/>

    <p>¿Ya tienes una cuenta? <router-link :to="{name: 'Login'}">Ingresar</router-link></p>
  </v-container>
</template>

<script>
import OwnerForm from "../../../components/auth/sing-up/OwnerForm";
export default {
  name: "OwnerSingUp",
  components: {OwnerForm}
}
</script>

<style scoped>

</style>
