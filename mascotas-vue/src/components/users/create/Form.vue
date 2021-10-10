<template>
    <v-form
        action="#"
        method="post"
        @submit.prevent="create(user)"
    >

    <!-- <input type="hidden" name="_token" :value="csrf"> -->

    <v-text-field
          type="text"
          required
          name="first_name"
          id="first_name"
          class="form-control"
          v-model="user.first_name"
          label="Nombre"
          :rules="[rules.obligatory]"
          :messages="errors.first_name ? errors.first_name[0] : ''"
          :error="errors.first_name !== null"
          :disabled="loading"
      ></v-text-field>

      <v-text-field
          type="text"
          required
          name="last_name"
          id="last_name"
          class="form-control"
          v-model="user.last_name"
          label="Apellido"
          :rules="[rules.obligatory]"
          :messages="errors.last_name ? errors.last_name[0] : ''"
          :error="errors.last_name !== null"
          :disabled="loading"
      ></v-text-field>

      <v-text-field
          type="text"
          required
          name="email"
          id="email"
          class="form-control"
          v-model="user.email"
          label="Correo electrónico"
          :rules="[rules.obligatory, rules.email]"
          :messages="errors.email ? errors.email[0] : ''"
          :error="errors.email !== null"
          :disabled="loading"
      ></v-text-field>

      <v-text-field
          type="text"
          required
          name="password"
          id="password"
          class="form-control"
          v-model="user.password"
          label="Contraseña"
          :rules="[rules.obligatory]"
          :messages="errors.password ? errors.password[0] : ''"
          :error="errors.password !== null"
          :disabled="loading"
      ></v-text-field>

      <v-text-field
          type="text"
          name="address"
          id="address"
          class="form-control"
          v-model="user.address"
          label="Dirección"
          :disabled="loading"
      ></v-text-field>

      <v-text-field
          type="text"
          name="dni"
          id="dni"
          class="form-control"
          v-model="user.dni"
          label="DNI"
          :rules="[rules.numeric]"
          :messages="errors.dni ? errors.dni[0] : ''"
          :error="errors.dni !== null"
          :disabled="loading"
      ></v-text-field>

      <v-textarea
          name="description"
          id="description"
          class="form-control"
          v-model="user.description"
          label="Descripción"
          :disabled="loading"
      ></v-textarea>

      <v-text-field
          type="text"
          name="web"
          id="web"
          class="form-control"
          v-model="user.web"
          label="Página Web"
          :disabled="loading"
      ></v-text-field>

       <v-text-field
          type="text"
          name="phone"
          id="phone"
          class="form-control"
          v-model="user.phone"
          label="Número de teléfono"
          :disabled="loading"
      ></v-text-field>
    <v-btn
          type="submit"
      >
        Publicar
      </v-btn>
    </v-form>
</template>

<script>
import userService from "@/services/users";

export default {
  name: "Form",
  data: function () {
    return {
      loading: false,
      user: {
        first_name: null,
        last_name: null,
        email: null,
        password: null,
        address: null,
        dni: null,
        description: null,
        web: null,
        phone_number: null,
      },
      errors: {
        first_name: null,
        last_name: null,
        email: null,
        password: null,
        dni: null,
      },
      rules: {
        obligatory: value => !!value || 'Este campo es obligatorio.',
        numeric: value => !isNaN(value) || 'El valor debe ser numérico.',
        email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'El correo electrónico no es válido.'
          },
      },
    }
  },
  methods: {
    create(user) {
      userService.create(user);
    }
  }
}

</script>

<style scoped>

</style>