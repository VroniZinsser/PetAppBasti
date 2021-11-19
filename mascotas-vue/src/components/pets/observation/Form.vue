<template>
  <v-form
      action="observaciones/crear"
      method="post"
      ref="observationForm"
      @submit.prevent="updateObservation"
  >
    <InputText
        label="Observacion"
        v-model="formData.observation"
        identifier="observation"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors['data.observation']"
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
    pet_id: {
      type: String,
      required: true,
    },
  },
  data: function () {
    return {
      loading: false,
      formData: {
        observation: null,
      },
      errors: {
        'data.observation': null,
      },
      rules: {
        obligatory: value => !!value || 'Este campo es obligatorio.',
      }
    }
  },
  methods: {
    updateObservation() {
      if (this.$refs.observationForm.validate()) {
        this.loading = true;
        this.errors = {
          'data.observation': null,
        }
        petServices.updateObservation(this.pet_id, this.formData)
            .then(res => {
              this.loading = false;
              if (!res.success) {
                if (res.errors && res.errors.pets_id) {
                  alert('La mascota no existe.');
                } else if (this.errors) {
                  this.errors = {
                    'data.observation': null,
                    ...res.errors
                  }
                } else {
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
