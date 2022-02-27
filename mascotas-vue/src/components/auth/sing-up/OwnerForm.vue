<template>
  <v-form
      action="usuario/dueño"
      method="post"
      ref="ownerForm"
      @submit.prevent="sendForm"
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
        v-if="!user"
        :type="showPassword ? 'text' : 'password'"
        label="Contraseña"
        v-model="formData.password"
        hint="La contraseña debe tener mínimo 6 caracteres y contener al menos un número"
        persistent-hint
        :loading="loading"
        :rules="[rules.obligatory, rules.password, rules.passwordMin]"
        :errors="errors.password"
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        @click:append="showPassword = !showPassword"
    ></InputText>

    <button class="main-btn" type="submit" :disabled="loading">{{ user ? 'Guardar cambios' : 'Crear cuenta'}}</button>
    <DeleteAccountButton 
      v-if="user"
    />
  </v-form>
</template>

<script>
import InputText from "../../general/inputs/InputText";
import DeleteAccountButton from "@/components/general/buttons/DeleteAccountButton";
import userService from "../../../services/users";
import authService from "../../../services/auth";
import store from "@/store";


export default {
  name: "OwnerForm",
  components: {
    InputText,
    DeleteAccountButton,
  },
  props: {
    user: {
      type: Object,
      default: null,
    },
  },
  data: () => ({
    showPassword: false,
    loading: false,
    store,
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
      obligatory: value => !!value || 'Este campo es obligatorio',
      email: value => {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return pattern.test(value) || 'El correo electrónico no es válido';
      },
      password: value => {
        const pattern = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
        return pattern.test(value) || 'La contraseña debe contener como mínimo una letra y un número'
      },
      passwordMin: value => (value && value.length >= 6) || 'La contraseña debe de tener como mínimo 6 caracteres',
    },
  }),
  methods: {
    sendForm() {
      if (this.$refs.ownerForm.validate()) {
        this.loading = true;

        this.errors = {
          first_name: null,
          last_name: null,
          email: null,
          password: null,
        }

        if (!this.user) {
          this.signUp();
        } else {
          this.updateUser();
        }
      }

    },
    /**
     * Attempt to create a new user with the role of owner, if something fails it will show error messages and why it failed.
     * If the process completes successfully the user will be authenticated and sent to home.
     */
    signUp() {
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
              this.store.setStatus({
                msg: "¡Algo salió mal! Por favor, intentalo nuevamente más tarde",
                type: 'error'
              });
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
      
    },

    updateUser() {
      userService.update(this.formData, this.user.id)
        .then(res => {
          this.loading = false;

          if (!res.success) {
            if (res.errors) {
              this.errors = {
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                ...res.errors
              }
              this.store.setStatus({
                msg: "Por favor corregí los datos del formulario.",
                type: 'warning',
              });
            } else {
              this.store.setStatus({
                msg: '¡Algo salió mal! Por favor, intentalo nuevamente más tarde.',
                type: 'error',
              });
            }
          } else {
            authService.saveAuthUser(res.data.user);
            this.store.setStatus({
              msg: 'Los cambios se guardaron con éxito.',
              type: 'success',
            });
            this.$router.back();
          }
        })
    }
  },
  mounted() {
    if (this.user) {
      this.formData = {
        ...this.user
      }
    }
  },
}
</script>

<style scoped>

</style>
