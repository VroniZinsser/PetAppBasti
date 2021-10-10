<template>
  <v-container fluid>
    <h1>Login</h1>
    <Form />
  </v-container>
</template>

<script>

import Form from "@/components/users/login/Form";

export default {
  name: "LoginForm",
  components: {
    Form
  },
  data: () => ({
    loading: true,
    user_types: [],
  }),
}
</script>

<style scoped>

</style>