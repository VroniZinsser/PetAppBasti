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
        <v-date-picker v-model="formData.date"></v-date-picker>
    </v-form>
</template>
<script>
import InputText from "@/components/general/inputs/InputText";

export default {
  name: "Form",
  components: {
    InputText,
  },
  props: {
    dateTime: String
  },
  data: function() {
    return {
      loading: false,
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
      const current = new Date();
      const date = current.getFullYear() + '-' + (current.getMonth()+1) + '-' + current.getDate();
      return date;
    }
  },
}
</script>
