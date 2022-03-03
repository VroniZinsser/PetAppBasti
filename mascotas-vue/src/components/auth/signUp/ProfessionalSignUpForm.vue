<template>
  <v-form
      ref="form"
      :method="formMethod"
      :action="formAction"
      @submit.prevent="sendForm"
  >
    <v-container class="professional-form">
      <slot/>

      <div class="fieldset-container">
        <fieldset>
          <legend>Datos personales</legend>

          <BaseNotification
              v-if="store.status.msg != null"
              :text="store.status.msg"
              :title="store.status.title"
              :type="store.status.type"
          />

          <p>Los campos marcados con * son obligatorios.</p>

          <InputText
              v-model="formData.first_name"
              label="Nombre"
              identifier="first_name"
              :loading="loading"
              :rules="[rules.obligatory]"
              :errors="errors.first_name"
              autocomplete="on"
              required
          />

          <InputText
              v-model="formData.last_name"
              label="Apellido"
              identifier="last_name"
              :loading="loading"
              :rules="[rules.obligatory]"
              :errors="errors.last_name"
              autocomplete="on"
              required
          />

          <InputText
              v-model="formData.dni"
              label="DNI"
              identifier="dni"
              :loading="loading"
              :rules="[rules.obligatory, rules.numeric]"
              :errors="errors.dni"
              autocomplete="on"
              required
          />

          <InputText
              v-model="formData.email"
              label="Correo Electrónico"
              identifier="email"
              :loading="loading"
              :rules="[rules.obligatory, rules.email]"
              :errors="errors.email"
              autocomplete="on"
              required
              type="email"
          />

          <v-switch
              v-model="formData.email_visible"
              :label="`Mostrar correo electrónico en mi perfil: ${emailVisible}`"
              hint="Si activás esta función, los clientes te podrán contactar por correo electrónico."
              persistent-hint
              color="#3fb094"
          />

          <InputPassword
              v-if="createNewUser"
              v-model="formData.password"
              label="Contraseña"
              :loading="loading"
              :errors="errors.password"
          />
        </fieldset>

        <fieldset>
          <legend>Perfil público</legend>

          <InputText
              v-model="formData.public_name"
              label="Nombre Institucional"
              identifier="public_name"
              :loading="loading"
              :errors="errors.public_name"
              hint="Nombre de la tienda o clínica veterinaria"
              persistent-hint
          />

          <v-select
              v-model="formData.user_types"
              label="Tipo de servicios *"
              outlined
              :items="user_types"
              :item-text="'name'"
              :item-value="'id'"
              chips
              multiple
              :messages="errors.user_types ? errors.user_types[0] : ''"
              :error="errors.user_types"
              :disabled="loading"
              :rules="[rules.selectionRequired]"
              color="#3fb094"
          />

          <v-textarea
              id="description"
              v-model="formData.description"
              outlined
              name="description"
              class="form-control"
              label="Texto de presentación"
              :messages="errors.description ? errors.description[0] : ''"
              :error="errors.description"
              :disabled="loading"
              placeholder="Hola, soy Martina y soy veterinaria con alma y corazón..."
              color="#3fb094"
          />

          <div :class="!createNewUser ? 'preview-container' : ''">
            <v-switch
                v-if="!createNewUser"
                v-model="showFileInput"
                :label="`Nueva imagen: ${showFileInput ? 'Sí' : 'No'}`"
                color="#3fb094"
            />

            <v-img
                v-if="!createNewUser && !showFileInput"
                class="preview"
                :src="createImgPath(professional.profile_image.src)"
            />

            <v-file-input
                v-if="createNewUser || showFileInput"
                v-model="photo"
                outlined
                required
                ref="photo"
                show-size
                accept="image/*"
                prepend-icon=""
                prepend-inner-icon="mdi-camera"
                truncate-length="15"
                label="Imagen de Perfil *"
                :rules="[rules.obligatory]"
                :messages="errors.photo ? errors.photo[0] : ''"
                :error="errors.photo"
                :disabled="loading"
                color="#3fb094"
                @change="handleFileUpload"
            />
          </div>
        </fieldset>

        <fieldset>
          <legend>Datos de contacto</legend>

          <InputText
              v-model="formData.whatsapp"
              label="Número de Whatsapp"
              identifier="whatsapp"
              required
              :loading="loading"
              :errors="errors.whatsapp"
              :rules="[rules.obligatory]"
              type="tel"
              autocomplete="on"
              placeholder="112345678"
          />

          <InputText
              v-model="formData.instagram"
              label="Instagram"
              identifier="instagram"
              :loading="loading"
              :errors="errors.instagram"
              :rules="[rules.username]"
              placeholder="VeterinariaMartina"
              hint="Tu nombre de usuario sin '@'"
          />

          <InputText
              v-model="formData.facebook"
              label="Facebook"
              identifier="facebook"
              :loading="loading"
              :errors="errors.facebook"
              :rules="[rules.username]"
              placeholder="veterinaria_martina"
              hint="Tu nombre de usuario como aparece en la barra de url"
          />

          <InputText
              v-model="formData.web"
              label="Página Web"
              identifier="web"
              :loading="loading"
              :errors="errors.web"
              type="url"
              :rules="[rules.url]"
              placeholder="https://www.veterinaria-martina.com.ar"
          />

          <div :class="previewContainerClass">
            <v-switch
                v-if="!createNewUser"
                v-model="showAddressInput"
                :label="`Nueva dirección: ${showAddressInputValidator}`"
                color="#3fb094"
            />

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
                hint="Ingresá ciudad, calle y número, para que tus clientes te puedan encontrar."
                persistent-hint
                required
                @update-address="updateAddress"
            />

            <InputText
                v-if="createNewUser || showAddressInput"
                v-model="formData.apartment"
                label="Número de piso y departamento"
                identifier="apartment"
                :loading="loading"
                :errors="errors.apartment"
            />
          </div>
        </fieldset>
      </div>

      <div class="button-container">
        <button class="main-btn" type="submit">{{ buttonText }}</button>

        <DeleteAccountButton
            v-if="!createNewUser"
            :is_professional="true"
        />
      </div>
    </v-container>
  </v-form>
</template>

<script>
import Address from "@/components/user/professional/ProfessionalProfileAddress"
import authService from "@/services/auth";
import BaseNotification from "@/components/general/notification/BaseNotification";
import DeleteAccountButton from "@/components/general/button/BaseButtonDeleteAccount";
import InputAddress from "@/components/general/input/InputAddress";
import InputText from "@/components/general/input/InputText";
import InputPassword from "@/components/general/input/InputPassword";
import store from "@/store";
import userService from "@/services/users";
import {createImgPath} from "@/helpers";
import {handleAccessError} from "@/helpers";

export default {
  name: "Form",
  components: {
    InputAddress,
    InputText,
    InputPassword,
    Address,
    BaseNotification,
    DeleteAccountButton
  },
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
  data() {
    return {
      loading: false,
      store,
      photo: null,
      formData: {
        first_name: null,
        last_name: null,
        email: null,
        email_visible: false,
        password: null,
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
        dni: null,
        public_name: null,
        description: null,
        whatsapp: null,
        instagram: null,
        facebook: null,
        web: null,
        user_types: [],
        photo: null
      },
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
  computed: {
    createNewUser() {
      return this.professional === null;
    },

    formMethod() {
      return this.createNewUser ? 'POST' : 'PUT';
    },

    formAction() {
      return this.createNewUser ? 'usuarios/crear' : 'usuarios/editar';
    },

    emailVisible() {
      return this.formData.email_visible ? 'Sí' : 'No';
    },

    previewContainerClass() {
      return !this.createNewUser ? 'preview-container' : '';
    },

    showAddressInputValidator() {
      return this.showAddressInput ? 'Sí' : 'No';
    },

    buttonText() {
      return this.professional ? 'Guardar cambios' : 'Crear cuenta'
    },
  },
  mounted() {
    this.resetErrors();
    if (!this.createNewUser) {
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

            window.scrollTo(0, 0);

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
      if (!this.showFileInput) this.formData.photo = null;

      userService.updateProfessional(this.formData, this.professional.id)
          .then(res => {
            this.loading = false;

            window.scrollTo(0, 0);

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
