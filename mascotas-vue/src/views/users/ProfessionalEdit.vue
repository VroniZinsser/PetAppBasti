<template>
  <FormContainer
    headline="Editar perfil"
    form_class="form-signup-professional"
    :is_short_form="false"
  >
    <p v-if="loading">Cargando...</p>

    <Form
        v-else
        :user_types="user_types"
        :professional="professional"
    >
    </Form>
  </FormContainer>

</template>

<script>

import Form from "@/components/users/create/professional/Form";
import FormContainer from "@/components/general/forms/FormContainer";
import userService from "@/services/users"
import store from "@/store";


export default {
  name: "ProfessionalEdit",
  components: {
    Form,
    FormContainer,
  },
  data: () => ({
    loading: true,
    user_types: [],
    professional: null,
    store,
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
