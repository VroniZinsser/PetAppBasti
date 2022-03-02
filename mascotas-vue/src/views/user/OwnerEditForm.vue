<template>
  <FormContainer
      v-if="!loading"
      headline="Editar tu perfil"
      form_class="form-usuario"
      :is_short_form="true"
  >
      <Form
        :user="user"
      ></Form>
  </FormContainer>
</template>

<script>

import Form from "@/components/auth/signUp/OwnerSignUpForm";
import userService from "@/services/users"
import store from "@/store";
import FormContainer from "@/components/general/form/BaseFormContainer";
import { handleAccessError } from "@/helpers";

export default {
  name: "OwnerEdit",
  components: {
    Form,
    FormContainer
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

<style scoped>

</style>
