<template>
  <v-container fluid>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <h1>Crear Usuario</h1>

    <p v-if="loading">Cargando...</p>

    <Form
        v-else-if="this.$route.meta.role === 'professional'"
        :user_types="user_types">
    </Form>
  </v-container>

</template>

<script>

import Form from "@/components/users/create/professional/Form";
import userService from "@/services/users"
import store from "@/store"
import BaseNotification from "@/components/general/notifications/BaseNotification"

export default {
  name: "CreateForm",
  components: {
    Form,
    BaseNotification,
  },
  data: () => ({
    loading: true,
    user_types: [],
    store,
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
