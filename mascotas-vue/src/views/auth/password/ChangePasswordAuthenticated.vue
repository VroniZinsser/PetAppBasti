<template>
    <Loader v-if="loading" />
    <FormContainer
        v-else
        headline="Cambiar Contraseña"
        :is_short_form="true"
    >
        <form
            action="autenticacion/cambiar-contrasena-autenticado"
            method="post"
            ref="form"
            @submit.prevent="changePassword"
        >
            <p>Para la seguridad de tu cuenta es importante que cambies tu contraseña regularmente.</p>
            <InputText
                :type="showPassword ? 'text' : 'password'"
                label="Contraseña actual"
                v-model="formData.currentPassword"
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="showPassword = !showPassword"
                :loading="loading"
                :errors="errors.currentPassword"
            ></InputText>
            <InputPassword
                label="Contraseña nueva" 
                v-model="formData.newPassword"
                :loading="loading"
                :errors="errors.newPassword"
            />
            <button class="main-btn" type="submit" :disabled="loading">Guardar contraseña</button>
        </form>
    </FormContainer>
  
</template>

<script>
import InputText from "@/components/general/input/InputText";
import InputPassword from "@/components/general/input/InputPassword";
import FormContainer from "@/components/general/form/BaseFormContainer";
import Loader from "@/components/general/layout/TheLoader";
import authService from "@/services/auth";
import store from "@/store";

export default {
  name: "ResetPasswordForm",
  components: {
    InputText,
    InputPassword,
    FormContainer,
    Loader,
  },
  data() {
      return {
        showPassword: false,
        loading: false,
        store,
        showFinalMessage: false,
        formData: {
            currentPassword: null,
            newPassword: null,
        },
        errors: {
            currentPassword: null,
            newPassword: null,
        },
        rules: {
            obligatory: value => !!value || 'Este campo es obligatorio.',
        },
      }

  },

  methods: {
      changePassword() {
          this.loading = true;

          this.errors = {
            currentPassword: null,
            newPassword: null,
          }

          authService.changePasswordAuthenticated(this.formData)
            .then(res => {
                this.loading = false;
                if (!res.success) {
                    if (res.errors) {
                        this.errors = {
                            ...res.errors
                        }
                    } else {
                        this.store.setStatus({
                            msg: 'Lamentablemente no se pudo cambiar la contraseña. ' + res.msg ? res.msg : '',
                            type: 'error',
                        });
                    }
                    this.formData = {
                        currentPassword: null,
                        newPassword: null,
                    }
                } else {
                    // password changed successfully -> force user to log in with new credentials
                    this.logout();
                }
            })
      },
      logout() {
        this.showSettingsDialog = false;
        this.store.setActivePet(null);
        this.store.setStatus({
            msg: 'Ya te podés loguear con tu nueva contraseña',
            type: 'success',
        });
        authService.logout()
            .then(() => {
                this.dialog = false;
                this.$router.push({name: 'Login'});
            });
        },
  }
}
</script>