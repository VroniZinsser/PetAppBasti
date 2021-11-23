<template>
  <v-form
      action="usuario/dueño"
      method="post"
      ref="ownerForm"
      @submit.prevent="singUp"
  >
    <InputText
        label="Nombre"
        v-model="formData.first_name"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors.first_name"
    ></InputText>

    <InputText
        label="Apellido"
        v-model="formData.last_name"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors.last_name"
    ></InputText>

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
        :rules="[rules.obligatory]"
        :errors="errors.password"
    ></InputText>

    <v-btn type="submit" :disabled="loading">Crear cuenta</v-btn>
  </v-form>
</template>

<script>
import InputText from "../../general/inputs/InputText";
import userService from "../../../services/users";
import authService from "../../../services/auth";

export default {
  name: "OwnerForm",
  components: {InputText},
  data: () => ({
    showPassword: false,
    loading: false,
    formData: {
      first_name: null,
      last_name: null,
      email: null,
      password: null,
    },
    errors: {
      first_name: null,
      last_name: null,
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
     * Attempt to create a new user with the role of owner, if something fails it will show error messages and why it failed.
     * If the process completes successfully the user will be authenticated and sent to home.
     */
    singUp() {
      if (this.$refs.ownerForm.validate()) {
        this.loading = true;

        this.errors = {
          email: null,
          password: null,
        }

        userService.createOwner(this.formData)
            .then(res => {
              if (!res.success) {
                if (res.errors) {
                  this.errors = {
                    first_name: null,
                    last_name: null,
                    email: null,
                    password: null,
                    ...res.errors
                  }
                } else {
                  alert('Hubo un error inesperado, inténtalo de nuevo más tarde y si el problema persiste póngase en contacto a través de...');
                }
              } else {
                let credentials = {
                  email: this.formData.email,
                  password: this.formData.password,
                }

                authService.login(credentials)
                    .then(res => {
                      authService.saveAuthUser(res.data.user);

                      this.$router.push({name: 'Home'});
                    });
              }
              this.loading = false
            });
      }
    }
  },
  mounted() {
  }
}
</script>

<style scoped>

</style>
