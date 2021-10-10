<template>
  <v-sheet>
    <h1>Nuevo Usuario</h1>
    <Form />
  </v-sheet>

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