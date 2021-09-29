<template>
  <v-sheet>
    <h1>Nuevo Usuario</h1>
    <usersNuevoForm />
  </v-sheet>

</template>

<script>

import UsersNuevoForm from "@/components/UsersNuevoForm";

export default {
  name: "UsersNuevo",
  components: {
    UsersNuevoForm
  }
}
</script>

<style scoped>

</style>