<template>
    <FormContainer
        headline="Recuperar Contraseña"
        form_class="form-forgot-password"
        :is_short_form="true"
    >
        <form 
            action="autenticacion/recuperar-password"
            method="post"
            ref="passwordRecoveryForm"
            @submit.prevent="sendPasswordRecovery"
        >
            <p>¡No te preocupes! Te enviamos un mail para que puedas establecer una nueva contraseña.</p>
            <InputText
                type="email"
                label="Correo electrónico"
                v-model="formData.email"
                :loading="loading"
                :rules="[rules.obligatory, rules.email]"
                :errors="errors.email"
            ></InputText>
            <button class="main-btn" type="submit" :disabled="loading">Enviar mail</button>
        </form>
    </FormContainer>
  
</template>

<script>
import InputText from "@/components/general/inputs/InputText";
import FormContainer from "@/components/general/forms/FormContainer";
import authService from "@/services/auth";

export default {
  name: "ForgotPassword",
  components: {
    InputText,
    FormContainer,
  },
  data() {
      return {
        loading: false,
        // store,
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
      sendPasswordRecovery() {
          authService.sendPasswordRecovery(this.formData);
      }
  }
}
</script>

<style scoped>

</style>
