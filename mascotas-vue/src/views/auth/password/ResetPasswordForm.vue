<template>
  <TheLoader v-if="loading"/>

  <BaseFormContainer
      v-else
      :is_short_form="true"
      headline="Recuperar Contraseña"
      form_class="form-forgot-password"
  >
    <p v-if="showFinalMessage">¡Listo! Si tu correo está registrado en Basti, dentro de poco te llegará un correo
      electrónico con un link para resetear tu contraseña.</p>

    <form
        v-else
        ref="passwordRecoveryForm"
        action="autenticacion/recuperar-contrasena"
        method="post"
        @submit.prevent="sendPasswordReset"
    >
      <p>¡No te preocupes! Te enviamos un mail para que puedas establecer una nueva contraseña.</p>

      <p>Recordá que el link que te enviamos es válido por <strong>60 minutos</strong>.</p>

      <InputText
          v-model="formData.email"
          :loading="loading"
          :rules="[rules.obligatory, rules.email]"
          :errors="errors.email"
          type="email"
          label="Correo electrónico"
      />

      <button class="main-btn" type="submit" :disabled="loading">Enviar mail</button>
      <div class="login-link-container">
        <router-link :to="{name: 'Login'}" class="default-link">Volver al inicio</router-link>
      </div>
    </form>
  </BaseFormContainer>
  
</template>

<script>
import authService from "@/services/auth";
import BaseFormContainer from "@/components/general/form/BaseFormContainer";
import InputText from "@/components/general/input/InputText";
import store from "@/store";
import TheLoader from "@/components/general/layout/TheLoader";

export default {
  name: "ResetPasswordForm",
  components: {
    InputText,
    BaseFormContainer,
    TheLoader,
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