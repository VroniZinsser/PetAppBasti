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
        <v-datetime-picker label="Select Datetime" v-model="formData.date_time"> </v-datetime-picker>
    </v-form>
</template>
<script>
import InputText from "@/components/general/inputs/InputText";

export default {
  name: "Form",
  components: {
        InputText,
    },
  data: () => ({
    loading: false,
    formData: {
      weight: null,
      date_time: null,
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
    },

    errors: {
      weight: null,
      date_time: null,
    },
    rules: {
      obligatory: v => !!v || 'Este campo es obligatorio.',
      numeric: value => !isNaN(value) || 'El valor debe ser numérico.',
    },
    methods: {
    currentDateTime() {
        const current = new Date();
        const date = current.getFullYear()+'-'+(current.getMonth()+1)+'-'+current.getDate();
        const time = current.getHours() + ":" + current.getMinutes() + ":" + current.getSeconds();
        const dateTime = date +' '+ time;
        
        return dateTime;
        }
    }
  })
}
</script>
