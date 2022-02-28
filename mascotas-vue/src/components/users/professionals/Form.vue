<template>
  <v-form
      :method="createNewUser ? 'POST' : 'PUT'"
      :action="createNewUser ? 'usuarios/crear' : 'usuarios/editar'"
      ref="form"
      @submit.prevent="sendForm"
  >
    <v-container class="professional-form">
      <slot />
      
      <div class="fieldset-container">
        <fieldset>
          <legend>Datos personales</legend>
          <BaseNotification
            v-if="store.status.msg != null"
            :type="store.status.type"
            :text="store.status.msg"
            :title="store.status.title"
          />
          <p>Los campos marcados con * son obligatorios.</p>
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
              label="DNI"
              v-model="formData.dni"
              identifier="dni"
              :loading="loading"
              :rules="[rules.obligatory, rules.numeric]"
              :errors="errors.dni"
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

          <InputPassword
            v-if="createNewUser"
            label="Contraseña" 
            v-model="formData.password"
            :loading="loading"
            :errors="errors.password"
          />
        
        </fieldset>

        <fieldset>
          <legend>Perfil público</legend>

          <InputText
              label="Nombre Institucional"
              v-model="formData.public_name"
              identifier="public_name"
              :loading="loading"
              :errors="errors.public_name"
              hint="Nombre de la tienda o clínica veterinaria"
              persistent-hint
          ></InputText>

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
              :error="errors.user_types"
              :disabled="loading"
              :rules="[rules.selectionRequired]"
              color="#3fb094"
          ></v-select>

          <v-textarea
              outlined
              name="description"
              id="description"
              class="form-control"
              v-model="formData.description"
              label="Texto de presentación"
              :messages="errors.description ? errors.description[0] : ''"
              :error="errors.description"
              :disabled="loading"
              placeholder="Hola, soy Martina y soy veterinaria con alma y corazón..."
              color="#3fb094"
          ></v-textarea>

          <div :class="!createNewUser ? 'preview-container' : ''">
            <v-switch
                v-if="!createNewUser"
                v-model="showFileInput"
                :label="`Nueva imagen: ${showFileInput ? 'Sí' : 'No'}`"
                color="#3fb094"
            ></v-switch>
          
          
            <v-img
              class="preview"
              v-if="!createNewUser && !showFileInput"
              :src="createImgPath(professional.profile_image.src)" 
            />
        
          
            <v-file-input
                v-if="createNewUser || showFileInput"
                outlined
                v-model="photo"
                required
                ref="photo"
                show-size
                accept="image/*"
                prepend-icon=""
                prepend-inner-icon="mdi-camera"
                truncate-length="15"
                @change="handleFileUpload"
                label="Imagen de Perfil *"
                :rules="[rules.obligatory]"
                :messages="errors.photo ? errors.photo[0] : ''"
                :error="errors.photo"
                :disabled="loading"
                color="#3fb094"
            ></v-file-input>
          </div>
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

          <div :class="!createNewUser ? 'preview-container' : ''">
            <v-switch
                v-if="!createNewUser"
                v-model="showAddressInput"
                :label="`Nueva dirección: ${showAddressInput ? 'Sí' : 'No'}`"
                color="#3fb094"
            ></v-switch>

            <Address 
              v-if="!createNewUser && !showAddressInput"
              :professional="professional" 
            />
          
            <InputAddress
                v-if="createNewUser || showAddressInput"
                label="Dirección"
                identifier="address"
                :loading="loading"
                :errors="errors.address"
                :rules="[rules.obligatory]"
                @update-address="updateAddress"
                hint="Ingresá ciudad, calle y número, para que tus clientes te puedan encontrar."
                persistent-hint
                required
            ></InputAddress>

            <InputText
                v-if="createNewUser || showAddressInput"
                label="Número de piso y departamento"
                v-model="formData.apartment"
                identifier="apartment"
                :loading="loading"
                :errors="errors.apartment"
            ></InputText>
            
          </div>
          
        </fieldset>
      </div>
      <div class="button-container">
        <button class="main-btn" type="submit">{{ professional ? 'Guardar cambios' : 'Crear cuenta'}}</button>
        <DeleteAccountButton 
            v-if="!createNewUser"
            :is_professional="true"
          />
      </div>
    </v-container>
  </v-form>
</template>

<script>
import userService from "@/services/users";
import authService from "@/services/auth";
import store from "@/store";
import InputAddress from "@/components/general/inputs/InputAddress";
import DeleteAccountButton from "@/components/general/buttons/DeleteAccountButton";
import InputText from "@/components/general/inputs/InputText";
import InputPassword from "@/components/general/inputs/InputPassword";
import {createImgPath} from "@/helpers";
import Address from "@/components/users/professionals/Address"
import BaseNotification from "@/components/general/notifications/BaseNotification";
import { handleAccessError } from "@/helpers";

export default {
  name: "Form",

  props: {
    user_types: {
      type: Array,
      required: true,
    },
    professional: {
      type: Object,
      default: null,
    }
  },

  computed: {
    createNewUser() {
      return this.professional === null;
    }
  },

  components: {
    InputAddress,
    InputText,
    InputPassword,
    Address,
    BaseNotification,
    DeleteAccountButton
  },

  data() {
    return {
      loading: false,
      store,
      photo: null,
      formData: {},
      errors: {},
      createImgPath,
      handleAccessError,
      rules: {
        obligatory: value => !!value || 'Este campo es obligatorio.',
        numeric: value => !isNaN(value) || 'El valor debe ser numérico.',
        selectionRequired: value => value.length > 0 || 'Por favor elegí una opción',
        email: value => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'El correo electrónico no es válido.'
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
      showAddressInput: false,
      showFileInput: false,
    }
  },

  mounted() {
    if (this.createNewUser) {
      this.resetFormData();
    } else {
      this.formData = {
        ...this.professional
      }
      this.cleanUserTypes();
      this.cleanProfileImage();
    }
  },
  
  methods: {
    sendForm() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        this.resetErrors();
        if (this.createNewUser) {
          this.createUser();
        } else {
          this.updateUser();
        }
      }
    },
    createUser() {
      userService.create(this.formData)
        .then(res => {
          this.loading = false;
          window.scrollTo(0,0);

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
      userService.updateProfessional(this.formData, this.professional.id)
        .then(res => {
          this.loading = false;
          window.scrollTo(0,0);
          
          if (res.success) {
            authService.saveAuthUser(res.data.user);
            this.store.setStatus({
              msg: "Los cambios se guardaron con éxito.",
              type: 'success',
            });

            this.$router.push({
              name: 'ProfessionalProfile', 
              params: {professional_id: this.professional.id}
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
            if (this.handleAccessError(res)) return;
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
     * Ensures that the array of user types contains only ids and not objects of user types
     */
    cleanUserTypes() {
      this.formData.user_types = this.formData.user_types.map((type) => {
        return isNaN(type) ? type.id : type;
      })
    },

    /**
     * Removes the profile image from formData
     * In formData we only need the attribute 'photo'
     */
    cleanProfileImage() {
      delete this.formData.profile_image;
    },

    resetErrors() {
      this.errors = {
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
      }
    },

    /**
      Sets default values to formData
      TODO: Remove default values for final version
     */
    resetFormData() {
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
}

</script>

<style scoped>

</style>
