<template>
    <v-form
        action="#"
        method="post"
        @submit.prevent="crear(user)"
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
          :rules="[reglas.obligatorio]"
          :messages="errores.first_name ? errores.first_name[0] : ''"
          :error="errores.first_name !== null"
          :disabled="cargando"
      ></v-text-field>

      <v-text-field
          type="text"
          required
          name="last_name"
          id="last_name"
          class="form-control"
          v-model="user.last_name"
          label="Apellido"
          :rules="[reglas.obligatorio]"
          :messages="errores.last_name ? errores.last_name[0] : ''"
          :error="errores.last_name !== null"
          :disabled="cargando"
      ></v-text-field>

      <v-text-field
          type="text"
          required
          name="email"
          id="email"
          class="form-control"
          v-model="user.email"
          label="Correo electrónico"
          :rules="[reglas.obligatorio, reglas.email]"
          :messages="errores.email ? errores.email[0] : ''"
          :error="errores.email !== null"
          :disabled="cargando"
      ></v-text-field>

      <v-text-field
          type="text"
          required
          name="password"
          id="password"
          class="form-control"
          v-model="user.password"
          label="Contraseña"
          :rules="[reglas.obligatorio]"
          :messages="errores.password ? errores.password[0] : ''"
          :error="errores.password !== null"
          :disabled="cargando"
      ></v-text-field>

      <v-text-field
          type="text"
          name="address"
          id="address"
          class="form-control"
          v-model="user.address"
          label="Dirección"
          :disabled="cargando"
      ></v-text-field>

      <v-text-field
          type="text"
          name="dni"
          id="dni"
          class="form-control"
          v-model="user.dni"
          label="DNI"
          :rules="[reglas.numerico]"
          :messages="errores.dni ? errores.dni[0] : ''"
          :error="errores.dni !== null"
          :disabled="cargando"
      ></v-text-field>

      <v-textarea
          name="description"
          id="description"
          class="form-control"
          v-model="user.description"
          label="Descripción"
          :disabled="cargando"
      ></v-textarea>

      <v-text-field
          type="text"
          name="web"
          id="web"
          class="form-control"
          v-model="user.web"
          label="Página Web"
          :disabled="cargando"
      ></v-text-field>

       <v-text-field
          type="text"
          name="phone"
          id="phone"
          class="form-control"
          v-model="user.phone"
          label="Número de teléfono"
          :disabled="cargando"
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
  name: "UsersNuevoForm",
  data: function () {
    return {
      cargando: false,
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
      errores: {
        first_name: null,
        last_name: null,
        email: null,
        password: null,
        dni: null,
      },
      reglas: {
        obligatorio: value => !!value || 'Este campo es obligatorio.',
        numerico: value => !isNaN(value) || 'El valor debe ser numérico.',
        email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'El correo electrónico no es válido.'
          },
      },
    }
  },
  methods: {
    crear(user) {
      userService.create(user);
    }
  }
}

</script>

<style scoped>

</style>