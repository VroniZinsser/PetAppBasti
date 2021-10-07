<template>
  <v-sheet>
    <h1>Nuevo Usuario</h1>
    <usersNewForm />
  </v-sheet>

</template>

<script>

import UsersNewForm from "@/components/UsersNewForm";

export default {
  name: "UsersNew",
  components: {
    UsersNewForm
  }
}
</script>

<style scoped>

</style>