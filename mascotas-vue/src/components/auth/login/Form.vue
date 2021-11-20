<template>
  <v-form
      action="#r"
      method="post"
      @submit.prevent=""
  >
    <v-text-field
        type="email"
        required
        name="email"
        id="email"
        class="form-control"
        label="Correo electrónico*"
        :rules="[rules.obligatory, rules.email]"
        :messages="errors.email ? errors.email[0] : ''"
        :error="errors.first_name !== null"
        :disabled="loading"
    ></v-text-field>

    <v-text-field
        :type="showPassword ? 'text' : 'password'"
        required
        name="password"
        id="password"
        class="form-control"
        label="Contraseña*"
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.obligatory]"
        :messages="errors.password ? errors.password[0] : ''"
        :error="errors.password !== null"
        :disabled="loading"
        counter
        @click:append="showPassword = !showPassword"
    ></v-text-field>
  </v-form>
</template>

<script>
export default {
  data: () => ({
    showPassword: false,
    loading: true,
    errors: {
      email: null,
      password: null,
    },
    rules: {
      obligatory: value => !!value || 'Este campo es obligatorio.',
      email: value => {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return pattern.test(value) || 'El correo electrónico no es válido.';
      }
    }
  }),
}
</script>

<style>

</style>
