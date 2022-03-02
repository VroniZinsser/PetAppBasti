<template>
  <div>
    <TitleBar title="Crear tu perfil"/>

    <TheLoader v-if="loading"/>

    <div v-else class="professional-form-container">
      <ProfessionalSignUpForm :user_types="user_types">
        <v-alert
            class="register-alert"
            colored-border
            border="left"
            color="#17a2b8"
            elevation="1"
            icon="mdi-account-plus"
            prominent
        >
          Con este formulario podés <strong>ofrecer tus servicios</strong> en Basti. Si querés usar Basti como dueña o
          dueño de mascota

          <router-link :to="{name: 'OwnerSignUp'}">registrate acá</router-link>
        </v-alert>
      </ProfessionalSignUpForm>
    </div>
  </div>
</template>

<script>
import ProfessionalSignUpForm from "@/components/auth/signUp/ProfessionalSignUpForm";
import TheLoader from "@/components/general/layout/TheLoader";
import TitleBar from "@/components/general/layout/TitleBar";
import userService from "@/services/users"

export default {
  name: "ProfessionalSignUp",
  components: {
    ProfessionalSignUpForm,
    TitleBar,
    TheLoader,
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