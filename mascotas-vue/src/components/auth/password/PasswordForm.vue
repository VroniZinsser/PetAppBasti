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
    <InputPassword 
      label="Nueva contraseña"
      v-model="formData.password"
      :loading="loading"
      :errors="errors.email"
    />
    <button class="main-btn" type="submit" :disabled="loading">Guardar contraseña</button>
  </v-form>
</template>

<script>
import InputText from "../../general/input/InputText";
import InputPassword from "../../general/input/InputPassword";
import authService from "../../../services/auth";
import store from "../../../store";

export default {
  name: 'Form',
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

<style>

</style>
