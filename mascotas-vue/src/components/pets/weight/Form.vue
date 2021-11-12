<template>
    <v-form 
        action="pesos/crear"
        method="post"
        ref="weightForm"
        @submit.prevent="createWeight">
        <InputText
            label="Peso en gramos"
            v-model="formData.weight"
            identifier="weight"
            :loading="loading"
            :rules="[rules.obligatory, rules.numeric]"
            :errors = "errors.weight"
            required
            type="number"
        ></InputText>
        <InputDate
          label="Fecha"
          identifier="date"
          :loading="loading"
          :rules="[rules.obligatory, rules.date]"
          :errors = "errors.date"
          :initialDate="getCurrentDate()"
          :maxDate="getCurrentDate()"
          @update-date="updateDate"
        ></InputDate>
      <v-btn type="submit" :disabled="loading">Agregar</v-btn>
    </v-form>
</template>
<script>
import InputText from "@/components/general/inputs/InputText";
import InputDate from "@/components/general/inputs/InputDate";
import weightService from "../../../services/weights";


export default {
  name: "Form",
  components: {
    InputText,
    InputDate
  },
  props: {
    pets_id: {
      type: String,
      required: true,
    },
  },
  data: function() {
    return {
      loading: false,
      formData: {
        weight: null,
        date: this.getCurrentDate(),
        pets_id: this.pets_id
      },

      errors: {
        weight: null,
        date: null,
      },
      rules: {
        obligatory: v => !!v || 'Este campo es obligatorio.',
        numeric: value => !isNaN(value) || 'El valor debe ser numérico.',
        date: value => {
            const pattern = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/;
            return pattern.test(value) || 'Por favor, ingresá una fecha válida (31/01/2021)'
        },
      }
    }
  },

   methods: {
    getCurrentDate() {
          return (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10);
    },
    updateDate(date) {
      this.formData.date = date;
    },

    createWeight() {
      if (this.$refs.weightForm.validate()) {
        this.loading = true;

        this.errors = {
          date: null,
          weight: null,
        }

        weightService.create(this.formData)
          .then(res => {
            this.loading = false;
            if (!res.success) {
              if(res.errors && res.errors.pets_id) {
                alert(res.errors.pets_id);
              } else if (this.errors) {
                this.errors = {
                  date: null,
                  weight: null,
                  ...res.errors
                }
              }else{
                alert("Hubo un error inesperado");
              }
            } else {
              alert("Peso guardado")
            }
          })
      }
    }
  },
}
</script>
