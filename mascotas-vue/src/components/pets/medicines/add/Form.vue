<template>
  <v-form
      action="/mascotas/medicamentos/agregar"
      method="post"
      ref="medicineForm"
      @submit.prevent="addMedicine"
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
        :initialDate="getCurrentDate()"
        @update-date="updateStartDate"
    ></InputDate>

    <InputDate
        label="Fin"
        v-model="formData.end_date"
        :loading="loading"
        :min-date="formData.start_date"
        :rules="[rules.obligatory, rules.date]"
        :errors="errors.end_date"
        :initialDate="getCurrentDate()"
        @update-date="updateEndDate"
    ></InputDate>

    <v-select
        v-model="formData.hours"
        identifier="hour"
        :disabled="loading"
        :items="hours"
        :item-text="'time'"
        :item-value="'id'"
        chips
        label="Horarios"
        multiple
        :rules="[rules.selectionRequired]"
        :messages="errors.hours ? errors.hours[0] : ''"
        :error="errors.hours !== null"
    ></v-select>

    <v-btn type="submit" :disabled="loading">Agregar</v-btn>
  </v-form>
</template>

<script>
import InputText from "../../../general/inputs/InputText";
import InputDate from "../../../general/inputs/InputDate";
import medicineServices from "../../../../services/medicines";
import store from "@/store";

export default {
  name: "Form",
  components: {InputDate, InputText},
  props: {
    hours: {
      type: Array,
      required: true
    },
  pet_id: {
    type: String,
    required: true,
  },
  },
  data: function () {
    return {
      loading: false,
      store,
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
    addMedicine() {
      if (this.$refs.medicineForm.validate()) {
        this.loading = true;

        this.errors = {
          name: null,
          quantity: null,
          start_date: null,
          end_date: null,
          hours: null,
        }

        medicineServices.create(this.formData)
            .then(res => {

              if (!res.success) {
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
              }
            })

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
  },
}
</script>

<style scoped>

</style>
