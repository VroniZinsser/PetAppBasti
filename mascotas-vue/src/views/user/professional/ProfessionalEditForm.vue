<template>
  <div>
    <TitleBar title="Editar tu perfil"></TitleBar>
    <Loader v-if="loading"></Loader>
    <div v-else class="professional-form-container">
      <Form
        :user_types="user_types"
        :professional="professional"
      ></Form>
    </div>
    
    </div>
</template>

<script>

import Form from "@/components/auth/signUp/ProfessionalSignUpForm";
import userService from "@/services/users"
import store from "@/store";
import TitleBar from "@/components/general/layout/TitleBar";
import Loader from "@/components/general/layout/TheLoader";
import { handleAccessError } from "@/helpers";

export default {
  name: "ProfessionalEdit",
  components: {
    Form,
    Loader,
    TitleBar,
 },
  data: () => ({
    loading: true,
    user_types: [],
    professional: null,
    store,
    handleAccessError,
  }),
  mounted() {
    userService.getProfessionalUserTypes()
        .then(res => {
          this.user_types = res.data.user_types;

          userService.getUserById(this.store.user.id)
            .then(res => {
                if (res.data.user) {
                    this.professional = res.data.user;
                } else {
                    if (this.handleAccessError(res)) return;
                    this.store.setStatus({
                        msg: 'Hubo un error mientras cargamos tus datos. Por favor intentalo más tarde.',
                        type: 'error',
                    });
                    this.$router.go(-1);
                }
                this.loading = false;
            })
            
        })
  }
}
</script>

<style scoped>

</style>
