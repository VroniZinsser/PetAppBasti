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

    <button type="submit" :disabled="loading">Guardar</button>
  </v-form>
</template>
<script>
import InputText from "@/components/general/inputs/InputText";
import petServices from "../../../services/pets";
import store from "@/store";

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
      store,
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
                  this.store.setStatus({
                    msg: 'La mascota no existe',
                    type: 'error',
                  });
                } else if (res.errors) {
                  this.errors = {
                    'data.observation': null,
                    ...res.errors
                  }
                  this.store.setStatus({
                    msg: "Por favor corregí los datos del formulario.",
                    type: 'warning',
                  });
                } else {
                  this.store.setStatus({
                    msg: 'Algo salió mal. La observación no se guardó correctamente.',
                    type: 'error',
                  });
                }
              } else {
                this.store.setStatus({
                  msg: '¡La observación está guardada!',
                  type: 'success',
                });
              }
            })
      }
    }
  },
}
</script>
