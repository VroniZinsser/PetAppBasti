<template>
    <v-form 
        action="pesos/crear"
        method="post"
        @submit.prevent="createWeight">
        <InputText
            label="Peso"
            v-model="formData.weight"
            identifier="weight"
            :loading="loading"
            :rules="[rules.obligatory]"
            :errors = "errors.weight"
            required
            type="number"
        ></InputText>
        <v-menu
          ref="datePicker"
          v-model="datePicker"
          :close-on-content-click="false"
          transition="scale-transition"
          offset-y
        >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="dateFormatted"
            label="Fecha"
            prepend-icon="mdi-calendar"
            v-bind="attrs"
            v-on="on"
            @blur="formData.date = parseDate(dateFormatted)"
          ></v-text-field>
        </template>
        <v-date-picker
          v-model="formData.date"
          no-title
          locale="es-AR"
          @input="datePicker = false"
          :max="getCurrentDate()"
        ></v-date-picker>
      </v-menu>
    </v-form>
</template>
<script>
import InputText from "@/components/general/inputs/InputText";

export default {
  name: "Form",
  components: {
    InputText,
  },
  data: function() {
    return {
      loading: false,
      dateFormatted: this.formatDate(this.getCurrentDate()),
      datePicker: false,
      formData: {
        weight: null,
        date: this.getCurrentDate(),
      },

      errors: {
        weight: null,
        date: null,
      },
      rules: {
        obligatory: v => !!v || 'Este campo es obligatorio.',
        numeric: value => !isNaN(value) || 'El valor debe ser numérico.',
      }
    }
  },

   methods: {
    getCurrentDate() {
      return (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10);
    },
    
    formatDate (date) {
      if (!date) return null

      const [year, month, day] = date.split('-')
      return `${month}/${day}/${year}`
    },
    
    parseDate (date) {
      if (!date) return null

      const [month, day, year] = date.split('/')
      return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
    },
  },
  watch: {
    'formData.date' () {
      this.dateFormatted = this.formatDate(this.formData.date)
    },
  },
}
</script>
