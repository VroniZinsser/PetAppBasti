<template>
  <div>
    <TitleBar title="Editar tu perfil"/>

    <TheLoader v-if="loading"/>

    <div v-else class="professional-form-container">
      <ProfessionalSignUpForm
          :user_types="user_types"
          :professional="professional"
      />
    </div>
  </div>
</template>

<script>
import ProfessionalSignUpForm from "@/components/auth/signUp/ProfessionalSignUpForm";
import store from "@/store";
import TheLoader from "@/components/general/layout/TheLoader";
import TitleBar from "@/components/general/layout/TitleBar";
import userService from "@/services/users"
import {handleAccessError} from "@/helpers";

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