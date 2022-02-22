<template>
 <div>
    <TitleBar title="Crear tu perfil"></TitleBar>
    <Loader v-if="loading"></Loader>
    
    <div v-else class="professional-form-container">
      <Form
          :user_types="user_types"
      >
        <p>Registrate acá si trabajás en el rubro veterinario y querés <strong>ofrecer tus servicios</strong> en Basti.</p>
      </Form>
    </div>
  </div>

</template>

<script>

import Form from "@/components/users/professionals/Form";
import userService from "@/services/users"
import TitleBar from "@/components/general/layouts/TitleBar";
import Loader from "@/components/general/notifications/Loader";

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
