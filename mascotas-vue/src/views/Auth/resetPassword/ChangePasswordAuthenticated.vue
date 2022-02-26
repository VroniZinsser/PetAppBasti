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
import InputText from "@/components/general/inputs/InputText";
import InputPassword from "@/components/general/inputs/InputPassword";
import FormContainer from "@/components/general/forms/FormContainer";
import Loader from "@/components/general/notifications/Loader";
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
            oldPassword: null,
        },
        errors: {
            currentPassword: null,
            oldPassword: null,
        },
        rules: {
            obligatory: value => !!value || 'Este campo es obligatorio.',
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