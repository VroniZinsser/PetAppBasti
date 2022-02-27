<template>
<div>
    <v-text-field
      outlined
      class="form-control"
      v-bind="$attrs"
      v-on="$listeners"
      :type="showPassword ? 'text' : 'password'"
      id="password"
      name="password"
      :rules="[rules.obligatory, rules.password]"
      :error="errors !== null"
      :messages="errors ? errors[0] : ''"
      :disabled="loading"
      color="#3fb094"
      hint="La contraseña debe tener mínimo 6 caracteres y contener un número"
      persistent-hint
      counter
      :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
      @click:append="showPassword = !showPassword"
  ></v-text-field>
</div>
    
</template>

<script>

export default {
  name: "InputPassword",
  data() { 
      return {
        showPassword: false,
        rules: {
            obligatory: value => !!value || 'Este campo es obligatorio.',
            password: value => {
                const pattern = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
                return pattern.test(value) || 'La contraseña debe tener mínimo 6 caracteres y contener un número'
            },
        },
      }
  },
  props: {
    errors: {
      default: null
    },
    loading: {
      type: Boolean,
      default: false
    }
    
  },
}

</script>