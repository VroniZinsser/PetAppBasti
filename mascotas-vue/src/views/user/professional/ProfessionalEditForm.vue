<template>
  <div>
    <TitleBar title="Editar tu perfil"></TitleBar>
    <TheLoader v-if="loading"></TheLoader>
    <div v-else class="professional-form-container">
      <ProfessionalSignUpForm
        :user_types="user_types"
        :professional="professional"
      ></ProfessionalSignUpForm>
    </div>
    
    </div>
</template>

<script>

import ProfessionalSignUpForm from "@/components/auth/signUp/ProfessionalSignUpForm";
import userService from "@/services/users"
import store from "@/store";
import TitleBar from "@/components/general/layout/TitleBar";
import TheLoader from "@/components/general/layout/TheLoader";
import { handleAccessError } from "@/helpers";

export default {
  name: "ProfessionalEditForm",
  components: {
    ProfessionalSignUpForm,
    TheLoader,
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
