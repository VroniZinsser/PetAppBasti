<template>
  <v-form
      :method="this.request ? 'PUT' : 'POST'"
      :action="this.request ? 'peticiones/editar' : 'peticiones/crear'"
      class="px-4 py-4"
      ref="requestForm"
      @submit.prevent="sendForm"
  >
    <BaseNotification v-if="notification.text" :text="notification.text" :type="notification.type"/>

    <v-select
        label="Mascota"
        v-model="formData.pet_id"
        identifier="hour"
        :disabled="loading"
        :items="pets"
        :item-text="'name'"
        :item-value="'id'"
        :messages="errors.pet_id ? errors.pet_id[0] : ''"
        :error="errors.pet_id !== null"
    ></v-select>

    <InputDate
        label="Fecha de expiración"
        v-model="formData.expiration_date"
        :loading="loading"
        :rules="[rules.obligatory, rules.date]"
        :errors="errors.expiration_date"
        :initialDate="getDefaultDate()"
        :minDate="getCurrentDate()"
        @update-date="updateDate"
    ></InputDate>

    <Textarea
        :label="'Tu mensaje a ' + professionalName"
        v-model="formData.description"
        :loading="loading"
        :errors="errors.description"
    ></Textarea>

    <button class="main-btn" type="submit" :disabled="loading">Generar enlace</button>
  </v-form>
</template>

<script>
import InputDate from "../../general/inputs/InputDate";
import Textarea from "../../general/inputs/Textarea";
import contactService from "../../../services/contact";
import BaseNotification from "../../general/notifications/BaseNotification";

export default {
  name: "Form",
  components: {BaseNotification, InputDate, Textarea},
  props: {
    pets: {
      type: Array,
      required: true,
    },
    request: {
      type: Object,
    },
    professionalName: {
      type: String,
      required: true,
    },
    professionalId: {
      type: Number,
      required: true,
    }
  },
  data() {
    return {
      loading: false,
      formData: {
        description: null,
        expiration_date: this.getDefaultDate(),
        pet_id: this.pets.length === 1 ? this.pets[0].id : null,
        professional_id: this.professionalId,
      },
      errors: {
        description: null,
        expiration_date: null,
        pet_id: null,
        professional_id: null,
      },
      notification: {
        text: null,
        type: 'success',
      },
      rules: {
        obligatory: v => !!v || 'Este campo es obligatorio.',
        date: value => {
          const pattern = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/;
          return pattern.test(value) || 'Por favor, ingresá una fecha válida (ej: 31/01/2021)'
        },
      }
    }
  },
  methods: {
    /**
     * Updates the start date of the medication
     * @param date | string
     */
    updateDate(date) {
      this.formData.expiration_date = date
    },

    /**
     * Returns the current date
     *
     * @returns {string}
     */
    getCurrentDate() {
      return (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10);
    },

    /**
     * Returns the default input date value - 1 week after today
     *
     * @returns {string}
     */
    getDefaultDate() {
      return (new Date((Date.now() + 604800000) - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10);
    },

    sendForm() {
      if (this.$refs.requestForm.validate()) {
        this.loading = true;

        this.errors = {
          description: null,
          expiration_date: null,
          pet_id: null,
          professional_id: null,
        }

        // Crear
        if (!this.request) {
          contactService.create(this.formData)
              .then(res => {
                if (!res.success) {
                  this.notification.type = 'error';

                  if (res.errors) {
                    this.errors = {
                      description: null,
                      expiration_date: null,
                      pet_id: null,
                      professional_id: null,
                      ...res.errors
                    }
                    this.notification.text = 'Por favor corregí los datos del formulario';
                  } else {
                    this.notification.text = 'Algo salió mal. No se pudo compartir la mascota';
                  }
                } else {
                  this.$emit('request-created', res.data.requestCreated);
                }

                this.loading = false;
              });
        } else {
          // Editar
          contactService.update(this.formData, this.request.id)
              .then(res => {
                if (!res.success) {
                  this.notification.type = 'error';

                  if (res.errors) {
                    this.errors = {
                      description: null,
                      expiration_date: null,
                      pet_id: null,
                      professional_id: null,
                      ...res.errors
                    }

                    this.notification.text = 'Por favor corregí los datos del formulario';
                  } else {
                    this.notification.text = 'Algo salió mal. No se pudo editar la petición';
                  }
                } else {
                  this.$emit('request-created', res.data.request);
                }

                this.loading = false;
              });
        }
      }
    }
  },
  mounted() {
    if (this.request) {
      this.formData = {
        description: null,
        expiration_date: null,
        pet_id: null,
        professional_id: null,
        ...this.request
      }
    }
  }
}
</script>
