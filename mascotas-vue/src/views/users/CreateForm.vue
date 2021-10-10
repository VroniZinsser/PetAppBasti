<template>
  <v-container fluid>
    <h1>Crear Usuario</h1>
    <Form />
  </v-container>

</template>

<script>

import Form from "@/components/users/create/Form";

export default {
  name: "CreateForm",
  components: {
    Form
  }
}
</script>

<style scoped>

</style>