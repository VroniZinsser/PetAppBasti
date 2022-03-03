<template>
  <BaseFormContainer
      v-if="!loading"
      :is_short_form="true"
      headline="Editar tu perfil"
      form_class="form-usuario"
  >
    <OwnerSignUpForm :user="user"/>
  </BaseFormContainer>
</template>

<script>
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import OwnerSignUpForm from "@/components/auth/signUp/OwnerSignUpForm";
import store from "@/store";
import userService from "@/services/users"
import {handleAccessError} from "@/helpers";

export default {
  name: "OwnerEditForm",
  components: {
    OwnerSignUpForm,
    BaseFormContainer
  },
  data: () => ({
    loading: true,
    user: null,
    store,
    handleAccessError,
  }),
  mounted() {
    userService.getUserById(this.store.user.id)
        .then(res => {
          if (res.data.user) {
            this.user = res.data.user;
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
  }
}
</script>
