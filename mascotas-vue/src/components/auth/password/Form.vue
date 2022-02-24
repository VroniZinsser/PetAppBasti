<template>
  <v-form
      action="autenticacion"
      method="post"
      ref="form"
      @submit.prevent="sendForm"
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
        label="Nueva contraseña"
        v-model="formData.password"
        identifier="password"
        :loading="loading"
        :rules="[rules.obligatory, rules.password]"
        :errors="errors.password"
        :type="showPassword ? 'text' : 'password'"
        hint="La contraseña debe tener mínimo 6 caracteres y contener un número"
        persistent-hint
        counter
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        @click:append="showPassword = !showPassword"
    ></InputText>

    <button class="main-btn" type="submit" :disabled="loading">Guardar contraseña</button>
  </v-form>
</template>

<script>
import InputText from "../../general/inputs/InputText";
import authService from "../../../services/auth";
import store from "../../../store";

export default {
  name: 'Form',
  components: {InputText},
  data() { 
      return {
        showPassword: false,
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
            password: value => {
                const pattern = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
                return pattern.test(value) || 'La contraseña no coincide con los estándares de seguridad'
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
                    msg: 'No se pudo cambiar la contraseña: ' + res.msg,
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

<style>

</style>
