<template>
  <v-form
      ref="loginForm"
      action="autenticacion"
      method="post"
      @submit.prevent="login"
  >
    <InputText
        v-model="formData.email"
        type="email"
        label="Correo electrónico"
        :loading="loading"
        :rules="[rules.obligatory, rules.email]"
        :errors="errors.email"
    />

    <InputText
        v-model="formData.password"
        :type="showPassword ? 'text' : 'password'"
        label="Contraseña"
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        :loading="loading"
        :errors="errors.password"
        @click:append="showPassword = !showPassword"
    />

    <div class="forgot-password">
      <router-link :to="{name: 'ResetPasswordForm'}" class="default-link">Olvidé mi Contraseña</router-link>
    </div>

    <button class="main-btn" type="submit" :disabled="loading">Iniciar sesión</button>
  </v-form>
</template>

<script>
import authService from "@/services/auth";
import InputText from "@/components/general/input/InputText";
import store from "@/store";
import {handleAccessError} from "@/helpers";

export default {
  name: 'LoginForm',
  components: {InputText},
  data: () => ({
    showPassword: false,
    loading: false,
    store,
    handleAccessError,
    formData: {
      email: null,
      password: null,
    },
    errors: {
      email: null,
      password: null,
    },
    rules: {
      obligatory: value => !!value || 'Este campo es obligatorio.',
      email: value => {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return pattern.test(value) || 'El correo electrónico no es válido.';
      },
    },
  }),
  methods: {
    /**
     * Attempts to authenticate the user
     */
    login() {
      if (this.$refs.loginForm.validate()) {
        this.loading = true;

        this.errors = {
          email: null,
          password: null,
        }

        authService.login(this.formData)
            .then(res => {
              if (!res.success) {
                if (this.handleAccessError(res)) return;

                if (res.errors) {
                  this.errors = {
                    email: null,
                    password: null,
                    ...res.errors
                  }
                } else {
                  this.store.setStatus({
                    msg: 'Uno o ambos campos son incorrectos.',
                    type: 'error',
                  });
                }

                this.formData.password = null;
              } else {
                authService.saveAuthUser(res.data.user);

                if (res.data.user.is_professional) {
                  this.$router.push({name: 'HomeProfessional'})
                } else {
                  this.$router.push({name: 'Pets'});
                }
              }

              this.loading = false
            });
      }
    },
  }
}
</script>
