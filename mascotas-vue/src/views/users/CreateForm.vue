<template>
  <v-container fluid>
    <h1>Crear Usuario</h1>
    <FormProfessional 
      v-if="this.$route.meta.role == 'professional'"
      :parentLoading="loading" 
          :user_types="user_types"></FormProfessional>
  </v-container>

</template>

<script>

import FormProfessional from "@/components/users/create/FormProfessional";
import userService from "@/services/users"

export default {
  name: "CreateForm",
  components: {
    FormProfessional
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