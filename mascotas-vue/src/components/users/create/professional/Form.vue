<template>
  <v-form
      :method="this.professional ? 'PUT' : 'POST'"
      :action="this.professional ? 'usuarios/editar' : 'usuarios/crear'"
      ref="form"
      @submit.prevent="sendForm"
  >
    <v-container>
      <p>Los campos marcados con * son obligatorios.</p>

      <fieldset>
        <legend>Datos personales</legend>

        <InputText
            label="Nombre"
            v-model="formData.first_name"
            identifier="first_name"
            :loading="loading"
            :rules="[rules.obligatory]"
            :errors="errors.first_name"
            autocomplete="on"
            required
        ></InputText>

        <InputText
            label="Apellido"
            v-model="formData.last_name"
            identifier="last_name"
            :loading="loading"
            :rules="[rules.obligatory]"
            :errors="errors.last_name"
            autocomplete="on"
            required
        ></InputText>

        <InputText
            label="Correo Electrónico"
            v-model="formData.email"
            identifier="email"
            :loading="loading"
            :rules="[rules.obligatory, rules.email]"
            :errors="errors.email"
            autocomplete="on"
            required
            type="email"
        ></InputText>

        <v-switch
            v-model="formData.email_visible"
            :label="`Mostrar correo electrónico en mi perfil: ${formData.email_visible ? 'Sí' : 'No'}`"
            hint="Si activás esta función, los clientes te podrán contactar por correo electrónico."
            persistent-hint
            color="#3fb094"
        ></v-switch>

        <InputText
            v-if="!professional"
            label="Contraseña"
            v-model="formData.password"
            identifier="password"
            :loading="loading"
            :rules="[rules.obligatory, rules.password]"
            :errors="errors.password"
            required
            :type="show_password ? 'text' : 'password'"
            hint="La contraseña debe tener mínimo 6 caracteres y contener un número"
            persistent-hint
            counter
            :append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'"
            @click:append="show_password = !show_password"
        ></InputText>

        <InputText
            label="DNI"
            v-model="formData.dni"
            identifier="dni"
            :loading="loading"
            :rules="[rules.obligatory, rules.numeric]"
            :errors="errors.dni"
            autocomplete="on"
            required
        ></InputText>
      </fieldset>

      <fieldset>
        <legend>Perfil público</legend>

        <v-select
            outlined
            v-model="formData.user_types"
            :items="user_types"
            :item-text="'name'"
            :item-value="'id'"
            chips
            label="Tipo de servicios *"
            multiple
            :messages="errors.user_types ? errors.user_types[0] : ''"
            :error="errors.user_types !== null"
            :disabled="loading"
            :rules="[rules.selectionRequired]"
            color="#3fb094"
        ></v-select>

        <InputText
            label="Nombre Institucional"
            v-model="formData.public_name"
            identifier="public_name"
            :loading="loading"
            :errors="errors.public_name"
            hint="Nombre de la tienda o clínica veterinaria"
            persistent-hint
        ></InputText>

        <InputAddress
            v-if="!professional"
            label="Dirección"
            identifier="address"
            :loading="loading"
            :errors="errors.address"
            @update-address="updateAddress"
            hint="Ingresá ciudad, calle y número, para que tus clientes te puedan encontrar."
            persistent-hint
        ></InputAddress>

        <InputText
            label="Número de piso y departamento"
            v-model="formData.apartment"
            identifier="apartment"
            :loading="loading"
            :errors="errors.apartment"
        ></InputText>
        <v-img 
          class="preview"
          v-if="professional"
          :src="createImgPath(professional.profile_image.src)" 
        />
        <v-btn @click="showFileInput = !showFileInput">{{ showFileInput ? 'Cancelar' : 'Cambiar imagen'}}</v-btn>
        <v-file-input
            v-if="!professional || showFileInput"
            outlined
            v-model="photo"
            required
            ref="photo"
            show-size
            accept="image/*"
            prepend-icon="mdi-camera"
            truncate-length="15"
            @change="handleFileUpload"
            label="Imagen de Perfil *"
            :rules="[rules.obligatory]"
            :messages="errors.photo ? errors.photo[0] : ''"
            :error="errors.photo !== null"
            :disabled="loading"
            color="#3fb094"
        ></v-file-input>

        <v-textarea
            outlined
            name="description"
            id="description"
            class="form-control"
            v-model="formData.description"
            label="Texto de presentación"
            :messages="errors.description ? errors.description[0] : ''"
            :error="errors.description !== null"
            :disabled="loading"
            placeholder="Hola, soy Martina y soy veterinaria con alma y corazón..."
            color="#3fb094"
        ></v-textarea>
      </fieldset>

      <fieldset>
        <legend>Datos de contacto</legend>

        <InputText
            label="Número de Whatsapp"
            v-model="formData.whatsapp"
            identifier="whatsapp"
            required
            :loading="loading"
            :errors="errors.whatsapp"
            :rules="[rules.obligatory]"
            type="tel"
            autocomplete="on"
            placeholder="112345678"
        ></InputText>

        <InputText
            label="Instagram"
            v-model="formData.instagram"
            identifier="instagram"
            :loading="loading"
            :errors="errors.instagram"
            :rules="[rules.username]"
            placeholder="VeterinariaMartina"
            hint="Tu nombre de usuario sin '@'"
        ></InputText>

        <InputText
            label="Facebook"
            v-model="formData.facebook"
            identifier="facebook"
            :loading="loading"
            :errors="errors.facebook"
            :rules="[rules.username]"
            placeholder="veterinaria_martina"
            hint="Tu nombre de usuario como aparece en la barra de url"
        ></InputText>

        <InputText
            label="Página Web"
            v-model="formData.web"
            identifier="web"
            :loading="loading"
            :errors="errors.web"
            type="url"
            :rules="[rules.url]"
            placeholder="https://www.veterinaria-martina.com.ar"
        ></InputText>
      </fieldset>

      <button class="main-btn" type="submit">{{ professional ? 'Guardar cambios' : 'Crear cuenta'}}</button>
    </v-container>
  </v-form>
</template>

<script>
import userService from "@/services/users";
import store from "@/store";
import InputAddress from "@/components/general/inputs/InputAddress";
import InputText from "@/components/general/inputs/InputText";
import {createImgPath} from "@/helpers";

export default {
  name: "Form",

  props: {
    user_types: {
      type: Array,
      required: true,
    },
    professional: {
      type: Object,
    }
  },
  components: {
    InputAddress,
    InputText,
  },
  data() {
    return {
      show_password: false,
      loading: false,
      store,
      photo: null,
      formData: {},
      createImgPath,
      errors: {
        first_name: null,
        last_name: null,
        email: null,
        email_visible: null,
        password: null,
        address: null,
        apartment: null,
        dni: null,
        public_name: null,
        description: null,
        whatsapp: null,
        instagram: null,
        facebook: null,
        web: null,
        user_types: null,
        photo: null
      },
      rules: {
        obligatory: value => !!value || 'Este campo es obligatorio.',
        numeric: value => !isNaN(value) || 'El valor debe ser numérico.',
        selectionRequired: value => value.length > 0 || 'Por favor elegí una opción',
        email: value => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'El correo electrónico no es válido.'
        },
        password: value => {
          const pattern = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
          return pattern.test(value) || 'La contraseña no coincide con los estándares de seguridad'
        },
        url: value => {
          const pattern = /^(ftp|http|https):\/\/[^ "]+$/;
          return (pattern.test(value) || !value) || 'La url ingresada no es válida.'
        },
        /**
         * FB and Instagram user names can only contain letters, numbers, '.' and '_'
         * This rule only works in the frontend right now.
         * @TODO Add rule to the backend
         */
        username: value => {
          const pattern = /^[a-z\d._]{3,}$/i;
          return (pattern.test(value) || !value) || 'El nombre de usuario ingresado no es válido.'
        },
      },
      showFileInput: false,
    }
  },
  
  methods: {
    sendForm() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        this.errors = {
          first_name: null,
          last_name: null,
          email: null,
          email_visible: null,
          password: null,
          apartment: null,
          dni: null,
          address: null,
          public_name: null,
          description: null,
          whatsapp: null,
          instagram: null,
          facebook: null,
          web: null,
          user_types: null,
          photo: null,
        }
        if (this.professional) {
          this.updateUser();
        } else {
          this.createUser();
        }
      }
    },
    createUser() {
      userService.create(this.formData)
          .then(res => {
            this.loading = false;

            if (res.success) {
              this.store.setStatus({
                msg: "¡Gracias por registrarte en Basti!",
                type: 'success',
              });

              this.$router.push({name: 'Login'});
            } else if (res.errors) {
              this.errors = {
                ...res.errors
              }
              this.errors.address = this.concatAddressErrors(res.errors);
              this.store.setStatus({
                msg: "Por favor corregí los datos del formulario.",
                type: 'warning'
              });

            } else {
              this.store.setStatus({
                msg: "¡Algo salió mal! Por favor, intentalo nuevamente más tarde",
                type: 'error'
              });
            }
          })
    },

    updateUser() {
      userService.update(this.formData, this.professional.id)
          .then(res => {
            this.loading = false;
            
            if (res.success) {
              this.store.setStatus({
                msg: "Los cambios se guardaron con éxito.",
                type: 'success',
              });

              this.$router.push({
                name: 'ProfessionalProfile', 
                params: {professional_id: this.professional_id}
              });
            } else if (res.errors) {
              this.errors = {
                ...res.errors
              }
              this.errors.address = this.concatAddressErrors(res.errors);
              this.store.setStatus({
                msg: "Por favor corregí los datos del formulario.",
                type: 'warning'
              });

            } else {
              this.store.setStatus({
                msg: "¡Algo salió mal! Por favor, intentalo nuevamente más tarde",
                type: 'error'
              });
            }
          })
    },

    updateAddress(address) {
      this.formData = {
        ...this.formData,
        ...address
      }
    },

    /**
     * Returns an array with all error messages related to the user's address
     * or null if there is no error.
     */
    concatAddressErrors(errors) {
      const addressErrors = [
        errors.country,
        errors.state,
        errors.city,
        errors.postal_code,
        errors.district,
        errors.street,
        errors.house_number,
        errors.latitude,
        errors.longitude
      ].filter(Array.isArray);

      if (addressErrors.length === 0) {
        return null;
      }

      let concatenatedErrors = [];

      for (let i = 0; i < addressErrors.length; i++) {
        concatenatedErrors = concatenatedErrors.concat(addressErrors[i]);
      }

      return concatenatedErrors;
    },

    /**
     * Transforms the image uploaded by the user to base64 and saves it in the photo property of user
     */
    handleFileUpload() {
      const reader = new FileReader();
      reader.addEventListener('load', () => {
        this.formData.photo = reader.result;
      });
      reader.readAsDataURL(this.photo);
    },
  },

  mounted() {
    if (this.professional) {
      this.formData = {
        ...this.professional
      }
    } else {
      this.formData = {
        first_name: "Alejo",
        last_name: "Gómez",
        email: "alejo.gomez@test.com",
        email_visible: false,
        password: "sdfoew3534+#a",
        country: null,
        state: null,
        city: null,
        postal_code: null,
        district: null,
        street: null,
        house_number: null,
        apartment: null,
        location_id: null,
        latitude: null,
        longitude: null,
        dni: "78473258",
        public_name: "Veterinario Alejo y Hermanos",
        description: null,
        whatsapp: "9112345678",
        instagram: "AlejoVet",
        facebook: null,
        web: null,
        user_types: [5, 6],
        photo: null
      }
    }
  }
}

</script>

<style scoped>

</style>
