<template>
    <v-form
        action="usuarios/crear"
        method="post"
        @submit.prevent="createUser"
    >
    
    <v-container>
      <p>Los campos marcados con * son obligatorios.</p>
      <fieldset>
        <legend>Datos personales</legend>
        <v-text-field
            type="text"
            autocomplete="on"
            required
            name="first_name"
            id="first_name"
            class="form-control"
            v-model="user.first_name"
            label="Nombre *"
            :rules="[rules.obligatory]"
            :messages="errors.first_name ? errors.first_name[0] : ''"
            :error="errors.first_name !== null"
            :disabled="loading"
        ></v-text-field>

        <v-text-field
            type="text"
            autocomplete="on"
            required
            name="last_name"
            id="last_name"
            class="form-control"
            v-model="user.last_name"
            label="Apellido *"
            :rules="[rules.obligatory]"
            :messages="errors.last_name ? errors.last_name[0] : ''"
            :error="errors.last_name !== null"
            :disabled="loading"
        ></v-text-field>

        <v-text-field
            type="email"
            autocomplete="on"
            required
            name="email"
            id="email"
            class="form-control"
            v-model="user.email"
            label="Correo electrónico *"
            :rules="[rules.obligatory, rules.email]"
            :messages="errors.email ? errors.email[0] : ''"
            :error="errors.email !== null"
            :disabled="loading"
        ></v-text-field>
        <v-switch
            v-model="user.email_visible"
            :label="`Mostrar correo electrónico en mi perfil: ${user.email_visible ? 'Sí' : 'No'}`"
            hint="Si activás esta función, los clientes te podrán contactar por correo electrónico."
            persistent-hint
        ></v-switch>

        <v-text-field
            :type="showPassword ? 'text' : 'password'"
            autocomplete="off"
            required
            name="password"
            id="password"
            class="form-control"
            v-model="user.password"
            label="Contraseña *"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.obligatory, rules.password]"
            hint="La contraseña debe tener mínimo 6 caracteres y contener un número"
            persistent-hint
            :messages="errors.password ? errors.password[0] : ''"
            :error="errors.password !== null"
            :disabled="loading"
            counter
            @click:append="showPassword = !showPassword"
        ></v-text-field>
        
      <v-text-field
            type="text"
            autocomplete="on"
            name="dni"
            id="dni"
            class="form-control"
            v-model="user.dni"
            required
            label="DNI *"
            :rules="[rules.obligatory, rules.numeric]"
            :messages="errors.dni ? errors.dni[0] : ''"
            :error="errors.dni !== null"
            :disabled="loading"
        ></v-text-field>
      </fieldset>

      <fieldset>
        <legend>Perfíl público</legend>
      
        <v-select
            v-model="user.user_types"
            :items="user_types"
            :item-text="'name'"
            :item-value="'id'"
            attach
            chips
            label="Tipo de servicios *"
            multiple
            :messages="errors.user_types ? errors.user_types[0] : ''"
            :error="errors.user_types !== null"
            :disabled="loading"
            :rules="[rules.selectionRequired]"
          ></v-select>

        <v-text-field
            type="text"
            name="public_name"
            id="public_name"
            class="form-control"
            v-model="user.public_name"
            label="Nombre Institucional"
            hint="Nombre de la tienda o clínica veterinaria"
            persistent-hint
            :messages="errors.public_name ? errors.public_name[0] : ''"
            :error="errors.public_name !== null"
            :disabled="loading"
        ></v-text-field>

        <v-autocomplete
            type="text"
            name="address"
            id="address"
            class="form-control"
            v-model="user.location_id"
            :items="address_suggestions"
            label="Dirección *"
            :search-input.sync="addressInput"
            no-data-text="Sin resultados"
            :rules="[rules.obligatory]"
            :messages="errors.location_id ? errors.location_id[0] : ''"
            :error="hasAddressError"
            :disabled="loading"
        ></v-autocomplete>
        <v-text-field
            type="text"
            autocomplete="on"
            name="apartment"
            id="apartment"
            class="form-control"
            v-model="user.apartment"
            label="Número de piso y departamento"
            :messages="errors.apartment ? errors.apartment[0] : ''"
            :error="errors.apartment !== null"
            :disabled="loading"
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
            label="Imagen de Perfil *"
            :rules="[rules.obligatory]"
            :messages="errors.photo ? errors.photo[0] : ''"
            :error="errors.photo !== null"
            :disabled="loading"
        ></v-file-input>

        <v-textarea
            name="description"
            id="description"
            class="form-control"
            v-model="user.description"
            label="Texto de presentación"
            :messages="errors.description ? errors.description[0] : ''"
            :error="errors.description !== null"
            :disabled="loading"
            placeholder="Hola, soy Martina y soy veterinaria con alma y corazón..."
        ></v-textarea>
      </fieldset>

      <fieldset>
        <legend>Datos de contacto</legend>
        <v-text-field
            type="tel"
            autocomplete="on"
            name="whatsapp"
            id="whatsapp"
            class="form-control"
            v-model="user.whatsapp"
            label="Número de whatsapp"
            placeholder="9112345678"
            :messages="errors.whatsapp ? errors.whatsapp[0] : ''"
            :error="errors.whatsapp !== null"
            :disabled="loading"
        ></v-text-field>

        <v-text-field
            type="text"
            autocomplete="on"
            name="instagram"
            id="instagram"
            class="form-control"
            v-model="user.instagram"
            label="Instagram"
            placeholder="VeterinariaMartina"
            hint="Tu nombre de usuario sin '@'"
            :messages="errors.instagram ? errors.instagram[0] : ''"
            :error="errors.instagram !== null"
            :disabled="loading"
            :rules="[rules.username]"
        ></v-text-field>

        <v-text-field
            type="text"
            autocomplete="on"
            name="facebook"
            id="facebook"
            class="form-control"
            v-model="user.facebook"
            label="Facebook"
            placeholder="veterinaria-martina"
            :messages="errors.facebook ? errors.facebook[0] : ''"
            :error="errors.facebook !== null"
            :disabled="loading"
            hint="Tu nombre de usuario como aparece en la barra de url"
            :rules="[rules.username]"
        ></v-text-field>

        <v-text-field
            type="url"
            name="web"
            id="web"
            class="form-control"
            v-model="user.web"
            label="Página Web"
            placeholder="https://www.veterinaria-martina.com.ar"
            :messages="errors.web ? errors.web[0] : ''"
            :error="errors.web !== null"
            :disabled="loading"
            :rules="[rules.url]"
        ></v-text-field>
      </fieldset>

      

      
    
      <v-btn type="submit" >
        Crear cuenta
      </v-btn>
    </v-container>
    </v-form>
</template>

<script>
import userService from "@/services/users";
import store from "@/store";
import {HEREMAPS_API_KEY} from "@/constants/"

export default {
  name: "FormProfessional",
  
  props: {
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
      addressInput: null,
      user: {
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
      },
      errors: {
        first_name: null,
        last_name: null,
        email: null,
        email_visible: null,
        password: null,
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
        email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'El correo electrónico no es válido.'
          },
        password: value => {
            const pattern = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
            return pattern.test(value) || 'La contraseña no coincide con los estandares de seguridad'
        },
        url: value => {
          const pattern = /^(ftp|http|https):\/\/[^ "]+$/;
          return (pattern.test(value) || !value) || 'La url ingresada no es válida.'
        },

        username: value => {
          const pattern = /^[a-z\d._]{3,}$/i;
          return (pattern.test(value) || !value) || 'El nombre de usuario ingresado no es válido.'
        },
        selectionRequired: value => value.length > 0 || 'Por favor elegí una opción'
      },
      address_suggestions: []
    }
  },
  methods: {
    createUser() {
      this.loading = true;
      userService.create(this.user)
        .then(res => {
            this.loading = false;
            if (res.success) {
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
                email_visible: null,
                password: null,
                apartment: null,
                dni: null,
                public_name: null,
                description: null,
                whatsapp: null,
                instagram: null,
                facebook: null,
                web: null,
                user_types: null,
                photo: null,
                ...res.errors
              }
            } else {
               this.store.setStatus({
                msg: "¡Algo salió mal! Por favor, intentalo nuevamente más tarde",
                type: 'error'
              });
            }
        })
    },

    hasAddressError() {
      return this.errors.country !== null
        || this.errors.city !== null
        || this.errors.state !== null
        || this.errors.postal_code !== null
        || this.errors.district !== null
        || this.errors.street !== null
        || this.errors.house_number !== null
        || this.errors.latitude !== null
        || this.errors.longitude !== null
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
  },
  watch: {
      addressInput: function(value) {
        fetch(`https://autocomplete.geocoder.ls.hereapi.com/6.2/suggest.json?apiKey=${HEREMAPS_API_KEY}&query=${value}`)
            .then(result => result.json())
            .then(result => {
                if(result.suggestions && result.suggestions.length > 0) {
                  this.address_suggestions = result.suggestions.map((suggestion) => {
                    const suggestionItem = {
                      'text': suggestion.label,
                      'value': suggestion.locationId,
                    }
                    return suggestionItem;
                  });
                    
                } else {
                  console.log('No hubo sugerencias.');
                  
                }
            }, error => {
                console.error(error);
            });
        },
        'user.location_id': function(location_id) {
            fetch(`https://geocoder.ls.hereapi.com/6.2/geocode.json?locationid=${location_id}&jsonattributes=1&gen=9&apiKey=${HEREMAPS_API_KEY}`)
              .then(res => res.json())
                  .then(res => {
                    if (res.response.view.length > 0 && res.response.view[0].result.length > 0) {
                      const location = res.response.view[0].result[0].location;
                      if (!location) {
                        return;
                      }
                      if(location.displayPosition) {
                        this.user.latitude = location.displayPosition.latitude;
                        this.user.longitude = location.displayPosition.longitude;
                      } 
                      if (location.address) {
                        this.user.country = location.address.country;
                        this.user.state = location.address.state;
                        this.user.city = location.address.city;
                        this.user.postal_code = location.address.postalCode;
                        this.user.district = location.address.district;
                        this.user.street = location.address.street;
                        this.user.house_number = location.address.houseNumber;
                      }
                    }
                  }, error => {
                      console.error(error);
                  });
          }
    },
    
}

</script>

<style scoped>
  fieldset {
    padding: 1em;
    margin: 1em 0;
  }

</style>