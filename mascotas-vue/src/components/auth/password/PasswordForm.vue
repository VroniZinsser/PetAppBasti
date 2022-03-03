<template>
  <v-form
      ref="form"
      action="autenticacion"
      method="post"
      @submit.prevent="sendForm"
  >
    <InputText
        v-model="formData.email"
        type="email"
        label="Correo electrónico"
        :loading="loading"
        :rules="[rules.obligatory, rules.email]"
        :errors="errors.email"
    />

    <InputPassword
        v-model="formData.password"
        label="Nueva contraseña"
        :loading="loading"
        :errors="errors.email"
    />

    <button class="main-btn" type="submit" :disabled="loading">Guardar contraseña</button>
  </v-form>
</template>

<script>
import authService from "@/services/auth";
import InputText from "@/components/general/input/InputText";
import InputPassword from "@/components/general/input/InputPassword";
import store from "@/store";

export default {
  name: 'ChangePassword',
  components: {
    InputText,
    InputPassword
  },
  data() {
    return {
      loading: false,
      store,
      formData: {
        email: null,
        password: null,
        token: this.$route.query.token
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
    }
  },
  methods: {
    /**
     * Attempts to authenticate the user
     */
    sendForm() {
      if (this.$refs.form.validate()) {
        this.loading = true;

        this.errors = {
          email: null,
          password: null,
        }

        authService.changePassword(this.formData)
            .then(res => {
              if (!res.success) {
                if (res.errors) {
                  this.errors = {
                    email: null,
                    password: null,
                    ...res.errors
                  }
                } else {
                  this.store.setStatus({
                    msg: 'Lamentablemente no se pudo cambiar la contraseña. ' + res.msg,
                    type: 'error',
                  });
                }

                this.formData.password = null;
              } else {
                this.store.setStatus({
                  msg: 'Ya te podés loguear con tu nueva contraseña',
                  type: 'success',
                });

                this.$router.push({name: 'Login'});
              }

              this.loading = false
            });
      }
    },
  }
}
</script>
