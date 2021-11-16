<template>
  <v-form
      action="/mascotas/medicamentos/agregar"
      method="post"
      @submit.prevent="addMedicine"
  >

    <InputText
        label="Nombre del medicamento"
        v-model="formData.name"
        :loading="loading"
        :errors = "errors.name"
    ></InputText>

    <InputText
        label="Cantidad"
        v-model="formData.quantity"
        :loading="loading"
        :errors = "errors.quantity"
    ></InputText>

    <InputDate
        label="Inicio"
        v-model="formData.start_date"
        :loading="loading"
        :errors = "errors.start_date"
        :initialDate="getCurrentDate()"
        @update-date="updateStartDate"
    ></InputDate>

    <InputDate
        label="Fin"
        v-model="formData.end_date"
        :loading="loading"
        :MinDate="formData.start_date"
        :errors = "errors.end_date"
        :initialDate="getCurrentDate()"
        @update-date="updateEndDate"
    ></InputDate>

    <!--TODO This field is not disabled-->
    <v-select
        v-model="formData.hours"
        :diabled="loading"
        :loading="loading"
        :items="hours"
        :item-text="'time'"
        :item-value="'id'"
        chips
        label="Horarios"
        multiple
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

export default {
  name: "Form",
  components: {InputDate, InputText},
  props: {
    hours: {
      type: Array,
      required: true
    }
  },
  data: function () {
    return {
      loading: false,
      formData: {
        name: null,
        quantity: null,
        start_date: this.getCurrentDate(),
        end_date: this.getCurrentDate(),
        hours: [],
      },
      errors: {
        name: null,
        quantity: null,
        start_date: null,
        end_date: null,
        hours: null,
      },
    }
  },
  methods: {
    updateStartDate(date){
      this.formData.start_date = date
    },

    updateEndDate(date){
      this.formData.end_date = date
    },

    addMedicine() {
      this.loading = true;

      this.errors = {
        name: null,
        quantity: null,
        start_date: null,
        end_date: null,
        hours: null,
      }

      medicineServices.add(this.$route.params.petsId, this.formData)
          .then(res => {
            console.warn(res)

            if (!res.success) {
              if (this.errors) {
                this.errors = {
                  name: null,
                  quantity: null,
                  start_date: null,
                  end_date: null,
                  hours: null,
                  ...res.errors
                }
              } else {
                alert("Hubo un error inesperado");
              }
            } else {
              alert("Medicamento agregado con éxito")
            }
          })

      this.loading = false
    },

    getCurrentDate() {
      return (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10);
    },
  },
}
</script>

<style scoped>

</style>
