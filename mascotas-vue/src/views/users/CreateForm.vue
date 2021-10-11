<template>
  <v-container fluid>
    <h1>Crear Usuario</h1>
    <Form :parentLoading="loading" 
          :user_types="user_types"></Form>
  </v-container>

</template>

<script>

import Form from "@/components/users/create/Form";
import userService from "@/services/users"

export default {
  name: "CreateForm",
  components: {
    Form
  },
  data: () => ({
    loading: true,
    user_types: [],
  }),
  mounted() {
    userService.createForm()
        .then(res => {
          this.user_types = res.data.user_types;
        })
    this.loading = false;
  }
}
</script>

<style scoped>

</style>