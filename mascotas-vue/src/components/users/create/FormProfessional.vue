<template>
    <v-form
        action="usuarios/crear"
        method="post"
        @submit.prevent="createUser"
    >
    <v-container>
      <v-row>
        <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
                type="text"
                required
                name="first_name"
                id="first_name"
                class="form-control"
                v-model="user.first_name"
                label="Nombre*"
                :rules="[rules.obligatory]"
                :messages="errors.first_name ? errors.first_name[0] : ''"
                :error="errors.first_name !== null"
                :disabled="parentLoading || loading"
            ></v-text-field>
        </v-col>

         <v-col
          cols="12"
          sm="6"
        >
            <v-text-field
                type="text"
                required
                name="last_name"
                id="last_name"
                class="form-control"
                v-model="user.last_name"
                label="Apellido*"
                :rules="[rules.obligatory]"
                :messages="errors.last_name ? errors.last_name[0] : ''"
                :error="errors.last_name !== null"
                :disabled="parentLoading || loading"
            ></v-text-field>
         </v-col>

          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
                type="email"
                required
                name="email"
                id="email"
                class="form-control"
                v-model="user.email"
                label="Correo electrónico*"
                :rules="[rules.obligatory, rules.email]"
                :messages="errors.email ? errors.email[0] : ''"
                :error="errors.email !== null"
                :disabled="parentLoading || loading"
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
                :type="showPassword ? 'text' : 'password'"
                required
                name="password"
                id="password"
                class="form-control"
                v-model="user.password"
                label="Contraseña*"
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[rules.obligatory, rules.password]"
                hint="La contraseña debe tener mínimo 6 caracteres y contener un número"
                persistent-hint
                :messages="errors.password ? errors.password[0] : ''"
                :error="errors.password !== null"
                :disabled="parentLoading || loading"
                counter
                @click:append="showPassword = !showPassword"
            ></v-text-field>
        </v-col>
      </v-row>

      <v-text-field
          type="text"
          name="address"
          id="address"
          class="form-control"
          v-model="user.address"
          required
          label="Dirección*"
          :rules="[rules.obligatory]"
          :disabled="parentLoading || loading"
      ></v-text-field>
      
      <v-file-input
          v-model="photo"
          required
          ref="photo"
          show-size
          accept="image/*"
          prepend-icon="mdi-camera"
          truncate-length="15"
          @change="handleFileUpload"
          label="Imagen de Perfil*"
          :rules="[rules.obligatory]"
          :messages="errors.photo ? errors.photo[0] : ''"
          :error="errors.photo !== null"
          :disabled="parentLoading || loading"
      ></v-file-input>

      <v-textarea
          name="description"
          id="description"
          class="form-control"
          v-model="user.description"
          label="Descripción"
          :disabled="parentLoading || loading"
      ></v-textarea>

      <v-text-field
          type="url"
          name="web"
          id="web"
          class="form-control"
          v-model="user.web"
          label="Página Web"
          :disabled="parentLoading || loading"
      ></v-text-field>

       <v-text-field
          type="tel"
          name="phone_number"
          id="phone_number"
          class="form-control"
          v-model="user.phone_number"
          label="Número de teléfono"
          :disabled="parentLoading || loading"
      ></v-text-field>

      <v-text-field
          type="text"
          name="dni"
          id="dni"
          class="form-control"
          v-model="user.dni"
          required
          label="DNI*"
          :rules="[rules.obligatory, rules.numeric]"
          :messages="errors.dni ? errors.dni[0] : ''"
          :error="errors.dni !== null"
          :disabled="parentLoading || loading"
      ></v-text-field>
       <v-checkbox
          v-for="type in user_types"
          :key="type.id"
          v-model="user.user_types"
          :label="type.name"
          :value="type.id"
          :disabled="parentLoading || loading"
          :rules="[rules.checkbox]"
        ></v-checkbox>
    <v-btn
          type="submit"
      >
        Crear cuenta
      </v-btn>
    </v-container>
    </v-form>
</template>

<script>
import userService from "@/services/users";
import store from "@/store";

export default {
  name: "FormProfessional",
  
  props: {
    parentLoading: {
      type: Boolean,
      required: true,
    },
    user_types: {
      type: Array,
      required: true,
    }
  },
  
  data: function () {
    return {
      showPassword: false,
      loading: false,
      store,
      photo: null,
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
        user_types: [],
        photo: null
      },
      errors: {
        first_name: null,
        last_name: null,
        email: null,
        password: null,
        address: null,
        dni: null,
        description: null,
        web: null,
        phone_number: null,
        user_types: null,
        photo: null
      },
      rules: {
        obligatory: value => !!value || 'Este campo es obligatorio.',
        numeric: value => !isNaN(value) || 'El valor debe ser numérico.',
        email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'El correo electrónico no es válido.'
          },
        password: value => {
            const pattern = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
            return pattern.test(value) || 'La contraseña no coincide con los estandares de seguridad'
        },
        checkbox: value => value.length > 0 || 'El checkbox debe ser true'
      },
    }
  },
  methods: {
    createUser() {
      this.loading = true;
      userService.create(this.user)
        .then(res => {
            this.loading = false;
            if (res.success) {
              this.user = {
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                address: null,
                dni: null,
                description: null,
                web: null,
                phone_number: null,
                user_types: [],
              }

              this.store.setStatus({
                msg: "¡Gracias por registrarte en Basti!",
                type: 'success'
              });

              this.$router.push('/usuarios/login');
            } else if (res.errors) {
              this.errors = {
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                address: null,
                dni: null,
                description: null,
                web: null,
                phone_number: null,
                user_types: null,
                photo: null,
                ...res.errors
              }
            }
        })
    },

    /**
     * Transforms the image uploaded by the user to base64 and saves it in the photo property of user
     */
    handleFileUpload() {
      const reader = new FileReader();
      reader.addEventListener('load', () => {
        this.user.photo = reader.result;
      });
      reader.readAsDataURL(this.photo);
    },
  }
}

</script>

<style scoped>

</style>