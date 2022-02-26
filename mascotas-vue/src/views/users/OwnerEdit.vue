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

import Form from "@/components/auth/signUp/OwnerForm";
import userService from "@/services/users"
import store from "@/store";
import FormContainer from "@/components/general/forms/FormContainer";



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
  }),
  mounted() {
    userService.getUserById(this.store.user.id)
        .then(res => {
            if (res.data.user) {
                this.user = res.data.user;
            } else {
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
