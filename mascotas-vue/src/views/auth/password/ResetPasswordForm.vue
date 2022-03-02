<template>
    <Loader v-if="loading" />
    <FormContainer
        v-else
        headline="Recuperar Contraseña"
        form_class="form-forgot-password"
        :is_short_form="true"
    >
        <p v-if="showFinalMessage">¡Listo! Si tu correo está registrado en Basti, dentro de poco te llegará un correo electrónico con un link para resetear tu contraseña.</p>
        <form
            v-else
            action="autenticacion/recuperar-contrasena"
            method="post"
            ref="passwordRecoveryForm"
            @submit.prevent="sendPasswordReset"
        >
            <p>¡No te preocupes! Te enviamos un mail para que puedas establecer una nueva contraseña.</p>
            <p>Recordá que el link que te enviamos es válido por <strong>60 minutos</strong>.</p>
            <InputText
                type="email"
                label="Correo electrónico"
                v-model="formData.email"
                :loading="loading"
                :rules="[rules.obligatory, rules.email]"
                :errors="errors.email"
            ></InputText>
            <button class="main-btn" type="submit" :disabled="loading">Enviar mail</button>
        </form>
    </FormContainer>
  
</template>

<script>
import InputText from "@/components/general/input/InputText";
import FormContainer from "@/components/general/form/BaseFormContainer";
import Loader from "@/components/general/layout/TheLoader";
import authService from "@/services/auth";
import store from "@/store";

export default {
  name: "ResetPasswordForm",
  components: {
    InputText,
    FormContainer,
    Loader,
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