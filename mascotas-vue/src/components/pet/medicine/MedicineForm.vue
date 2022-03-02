<template>
  <v-form
      :action="medicine ? 'medicamentos/editar' : 'medicamentos/crear'"
      method="post"
      ref="medicineForm"
      @submit.prevent="sendForm"
  >
    <InputText
        label="Nombre del medicamento"
        v-model="formData.name"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors.name"
    ></InputText>

    <InputText
        label="Cantidad"
        v-model="formData.quantity"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors.quantity"
    ></InputText>

    <InputDate
        label="Inicio"
        v-model="formData.start_date"
        :loading="loading"
        :rules="[rules.obligatory, rules.date]"
        :errors="errors.start_date"
        :initialDate="initialDate"
        @update-date="updateStartDate"
    ></InputDate>

    <InputDate
        label="Fin"
        v-model="formData.end_date"
        :loading="loading"
        :min-date="formData.start_date"
        :rules="[rules.obligatory, rules.date]"
        :errors="errors.end_date"
        :initialDate="finalDate"
        @update-date="updateEndDate"
    ></InputDate>

    <v-select
        v-model="formData.hours"
        identifier="hour"
        :disabled="loading"
        :items="retrieveDaytimeHours(hours)"
        :item-text="'time'"
        :item-value="'id'"
        chips
        label="Horarios"
        multiple
        :rules="[rules.selectionRequired]"
        :messages="errors.hours ? errors.hours[0] : ''"
        :error="errors.hours !== null"
    ></v-select>

    <button class="main-btn" type="submit" :disabled="loading">{{ medicine ? "Guardar cambios" : "Agregar" }}</button>
  </v-form>
</template>

<script>
import InputText from "../../general/input/InputText";
import InputDate from "../../general/input/InputDate";
import medicineServices from "../../../services/medicines";
import store from "@/store";
import { handleAccessError } from "@/helpers";

export default {
  name: "Form",
  components: {InputDate, InputText},
  props: {
    hours: {
      type: Array,
      required: true
    },
    pet_id: {
      type: [Number, String],
      required: true,
    },
    medicine: {
      type: Object,
      default: null,
    }
  },
  data: function () {
    return {
      loading: false,
      store,
      handleAccessError,
      formData: {
        name: null,
        quantity: null,
        start_date: this.getCurrentDate(),
        end_date: this.getCurrentDate(),
        hours: [],
        pet_id: this.pet_id,
      },
      errors: {
        name: null,
        quantity: null,
        start_date: null,
        end_date: null,
        hours: null,
      },
      rules: {
        obligatory: v => !!v || 'Este campo es obligatorio.',
        date: value => {
          const pattern = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/;
          return pattern.test(value) || 'Por favor, ingresá una fecha válida (ej: 31/01/2021)'
        },
        selectionRequired: value => value.length > 0 || 'Por favor seleccione un como mínimo una hora',
      }
    }
  },
  methods: {
    /**
     * Updates the start date of the medication
     * @param date | string
     */
    updateStartDate(date) {
      this.formData.start_date = date
    },

    /**
     * Updates the end date of the medication
     * @param date | string
     */
    updateEndDate(date) {
      this.formData.end_date = date
    },

    /**
     * Add the medication to the pet
     */
    sendForm() {
      if (this.$refs.medicineForm.validate()) {
        this.loading = true;

        this.errors = {
          name: null,
          quantity: null,
          start_date: null,
          end_date: null,
          hours: null,
        }

        if (!this.medicine) {
          medicineServices.create(this.formData)
              .then(res => {

                if (!res.success) {
                  if (this.handleAccessError(res)) return;
                  if (res.errors) {
                    this.errors = {
                      name: null,
                      quantity: null,
                      start_date: null,
                      end_date: null,
                      hours: null,
                      ...res.errors
                    }
                    this.store.setStatus({
                      msg: "Por favor corregí los datos del formulario.",
                      type: 'warning',
                    });
                  } else {
                    this.store.setStatus({
                      msg: 'Algo salió mal. El medicamento no se guardó correctamente.',
                      type: 'error',
                    });
                  }
                } else {
                  this.store.setStatus({
                    msg: '¡El nuevo medicamento está guardado!',
                    type: 'success',
                  });
                  this.$router.back();
                }
              })
        } else {
          medicineServices.update(this.formData, this.medicine.id)
              .then(res => {
                this.loading = false;

                if (!res.success) {
                  if (res.errors && res.errors.pet_id) {
                    this.store.setStatus({
                      msg: 'La mascota no existe.',
                      type: 'error',
                    });
                  } else if (res.errors) {
                    this.errors = {
                      name: null,
                      quantity: null,
                      start_date: null,
                      end_date: null,
                      hours: null,
                      ...res.errors
                    }
                    this.store.setStatus({
                      msg: "Por favor corregí los datos del formulario.",
                      type: 'warning',
                    });
                  } else {
                    this.store.setStatus({
                      msg: 'Algo salió mal. El medicamento no se editó correctamente.',
                      type: 'error',
                    });
                  }
                } else {
                  this.store.setStatus({
                    msg: '¡El medicamento se editó con éxito!',
                    type: 'success',
                  });
                  this.$router.back();
                }
              })
        }
        this.loading = false
      }
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
     * Retrieves hours from 08:00:00 to 22:00:00 based on hard coded ids and removes the seconds
     * TODO: This method is for presentational purposes and has to be refined
     */
    retrieveDaytimeHours(hours) {
      const firstHourId = 32;
      const lastHourId = 89;
      let daytimeHours = hours.slice(firstHourId, lastHourId + 1);
      daytimeHours.map((item) => {
        // show '08:30' instead of '08:30:00'
        item.time = item.time.slice(0, 5);
      })
      return daytimeHours;
    }
  },
  computed: {
    initialDate() {
      return this.medicine ? this.medicine.start_date : this.getCurrentDate();
    },

    finalDate() {
      return this.medicine ? this.medicine.end_date : this.getCurrentDate();
    }
  },
  mounted() {
    if (this.medicine) {
      this.formData.name = this.medicine.name;
      this.formData.date = this.medicine.date;

      let hours = [];
      for (const hour of this.medicine.hours) {
        hours.push(hour.id)
      }

      this.formData = {
        name: this.medicine.name,
        quantity: this.medicine.quantity,
        start_date: this.medicine.start_date,
        end_date: this.medicine.end_date,
        hours: hours,
        pet_id: this.pet_id,
      }
    }
  },
}
</script>

<style scoped>
</style>

