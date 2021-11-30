<template>
  <v-form
      action="autenticacion"
      method="post"
      ref="loginForm"
      @submit.prevent="login"
  >
    <InputText
        type="email"
        label="Correo electrónico"
        v-model="formData.email"
        :loading="loading"
        :rules="[rules.obligatory, rules.email]"
        :errors="errors.email"
    ></InputText>

    <InputText
        :type="showPassword ? 'text' : 'password'"
        label="Contraseña"
        v-model="formData.password"
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        @click:append="showPassword = !showPassword"
        :loading="loading"
        :errors="errors.password"
    ></InputText>

    <v-btn type="submit" :disabled="loading">Iniciar sesión</v-btn>
  </v-form>
</template>

<script>
import InputText from "../../general/inputs/InputText";
import authService from "../../../services/auth";
import store from "../../../store";

export default {
  name: 'Form',
  components: {InputText},
  data: () => ({
    showPassword: false,
    loading: false,
    store,
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
                if (res.errors) {
                  this.errors = {
                    email: null,
                    password: null,
                    ...res.errors
                  }
                } else {
                  alert('Uno o ambos campos son incorrectos');
                }
                this.formData.password = null;
              } else {
                authService.saveAuthUser(res.data.user);

                this.$router.push({name: 'Pets'});
              }

              this.loading = false
            });
      }
    },
  }
}
</script>

<style>

</style>
