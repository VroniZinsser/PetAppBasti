<template>
    <Loader v-if="loading" />
    <FormContainer
        v-else
        headline="Restablecer Contraseña"
        form_class="form-change-password"
        :is_short_form="true"
    >
        <Form />
        
    </FormContainer>
  
</template>

<script>
import InputText from "@/components/general/inputs/InputText";
import FormContainer from "@/components/general/forms/FormContainer";
import Loader from "@/components/general/notifications/Loader";
import Form from "@/components/auth/password/Form"
import authService from "@/services/auth";
import store from "@/store";

export default {
  name: "ChangePassword",
  components: {
    InputText,
    FormContainer,
    Loader,
    Form,
  },
  data() {
      return {
        loading: false,
        store,
        showFinalMessage: false,
        formData: {
            email: null,
        },
        errors: {
            email: null,
        },
        rules: {
            obligatory: value => !!value || 'Este campo es obligatorio.',
            email: value => {
                const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return pattern.test(value) || 'El correo electrónico no es válido.';
            },
        },
      }

  },

  methods: {
      sendPasswordReset() {
          this.loading = true;
          this.errors.email = null;
          authService.sendPasswordReset(this.formData)
            .then(res => {
                this.loading = false;
                if (res.errors && res.errors.email) {
                    this.errors.email = res.errors.email;
                } else { 
                    this.showFinalMessage = true;
                }
            });
      }
  }
}
</script>