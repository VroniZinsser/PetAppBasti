<template>
  <v-container fluid>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <h1>Login</h1>

    <Form/>
  </v-container>
</template>

<script>
import Form from "@/components/users/login/Form";
import BaseNotification from "@/components/general/notifications/BaseNotification"
import store from "@/store"

export default {
  name: "LoginForm",
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
