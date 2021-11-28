<template>
  <v-container fluid>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <h1>Ingresar</h1>

    <Form/>
    
    <p>¿Todavía no tienes una cuenta? <router-link :to="{name: 'OwnerSingUp'}">Registrarme</router-link></p>
  </v-container>
</template>

<script>
import Form from "@/components/auth/login/Form";
import BaseNotification from "@/components/general/notifications/BaseNotification"
import store from "@/store"

export default {
  name: "Login",
  components: {
    Form,
    BaseNotification,
  },
  data: () => ({
    loading: true,
    user_types: [],
    store,
  }),
}
</script>

<style scoped>

</style>
