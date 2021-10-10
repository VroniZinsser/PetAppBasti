<template>
  <v-container fluid>
    <h1>Crear Usuario</h1>
    <Form :loading="loading" 
          :usertypes="usertypes"></Form>
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
    usertypes: [],
  }),
  mounted() {
    userService.createForm()
        .then(res => {
          this.usertypes = res.data.usertypes;
        })
    this.loading = false;
  }
}
</script>

<style scoped>

</style>