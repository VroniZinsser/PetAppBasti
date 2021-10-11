<template>
  <v-container fluid>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />
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
import store from "@/store"
import BaseNotification from "@/components/general/notifications/BaseNotification"

export default {
  name: "CreateForm",
  components: {
    FormProfessional,
    BaseNotification
  },
  data: () => ({
    loading: true,
    user_types: [],
    store
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