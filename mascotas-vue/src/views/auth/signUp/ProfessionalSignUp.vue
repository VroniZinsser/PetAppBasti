<template>
 <div>
    <TitleBar title="Crear tu perfil"></TitleBar>
    <Loader v-if="loading"></Loader>
    
    <div v-else class="professional-form-container">
      <Form
          :user_types="user_types"
      >
        <v-alert
          class="register-alert"
          colored-border
          border="left"
          color="#17a2b8"
          elevation="1"
          icon="mdi-account-plus"
          prominent
        >
          Con este formulario podés <strong>ofrecer tus servicios</strong> en Basti. Si querés usar Basti como dueña o dueño de mascota <router-link :to="{name: 'OwnerSignUp'}">registrate acá</router-link>
        </v-alert>

      </Form>
    </div>
  </div>

</template>

<script>

import Form from "@/components/auth/signUp/ProfessionalSignUpForm";
import userService from "@/services/users"
import TitleBar from "@/components/general/layout/TitleBar";
import Loader from "@/components/general/layout/TheLoader";

export default {
  name: "ProfessionalSignUp",
  components: {
    Form,
    TitleBar,
    Loader,
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
