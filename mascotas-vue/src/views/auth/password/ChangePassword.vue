<template>
    <TheLoader v-if="loading" />
    <BaseFormContainer
        v-else
        headline="Restablecer Contraseña"
        form_class="form-change-password"
        :is_short_form="true"
    >
        <PasswordForm />
        
    </BaseFormContainer>
  
</template>

<script>
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import TheLoader from "@/components/general/layout/TheLoader";
import PasswordForm from "@/components/auth/password/PasswordForm"
import authService from "@/services/auth";
import store from "@/store";

export default {
  name: "ChangePassword",
  components: {
    BaseFormContainer,
    TheLoader,
    PasswordForm,
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