<template>
    <v-form 
        action="observaciones/crear"
        method="post"
        ref="observationForm"
        @submit.prevent="updateObservation">
        <InputText
            label="Observacion"
            v-model="formData.observation"
            identifier="observation"
            :loading="loading"
            :errors = "errors.observation"
            required
        ></InputText>
      <v-btn type="submit" :disabled="loading">Guardar</v-btn>
    </v-form>
</template>
<script>
import InputText from "@/components/general/inputs/InputText";
import petServices from "../../../services/pets";
export default {
  name: "Form",
  components: {
    InputText,
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
        observation: null,
        pets_id: this.pets_id
      },
      errors: {
        observation: null,
      },
    }
  },
   methods: {
    updateObservation() {
      if (this.$refs.observationForm.validate()) {
        this.loading = true;
        this.errors = {
            observation:null,
        }
        petServices.patch(this.formData)
          .then(res => {
            this.loading = false;
            if (!res.success) {
              if(res.errors && res.errors.pets_id) {
                alert(res.errors.pets_id);
              } else if (this.errors) {
                this.errors = {
                  observation: null,
                  ...res.errors
                }
              }else{
                alert("Hubo un error inesperado");
              }
            } else {
              alert("Observación guardada")
            }
          })
      }
    }
  },
}
</script> 