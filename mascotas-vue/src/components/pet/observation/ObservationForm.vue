<template>
  <div>
    <v-form
        action="observaciones/crear"
        method="post"
        ref="observationForm"
        @submit.prevent="updateObservation"
    >
    <Textarea
        label="Nota"
        v-model="formData.observation"
        identifier="observation"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors['data.observation']"
        required
    />

      <button class="main-btn" type="submit" :disabled="loading">Guardar</button>
    </v-form>

    <div class="delete-btn-container">
      <button class="delete-btn" :disabled="loading" @click="showWarnDialog = true">Borrar nota</button>
    </div>

    <WarnDialog
        :showDialog="showWarnDialog"
        dialogTitle="Borrar nota"
        dialogText="Podrás escribir una nueva nota cuando quieras"
        acceptButtonText="Borrar"
        @cancel="showWarnDialog = false"
        @accept="deleteObservation()"
    />
  </div>
</template>

<script>
import petServices from "@/services/pets";
import store from "@/store";
import Textarea from "@/components/general/input/Textarea";
import WarnDialog from "@/components/general/notification/BaseDialogWarn";
import {handleAccessError} from "@/helpers";

export default {
  name: "ObservationForm",
  components: {
    Textarea,
    WarnDialog,
  },
  props: {
    pet_id: {
      type: [String, Number],
      required: true,
    },
    observation: {
      type: String
    }
  },
  data: function () {
    return {
      loading: false,
      store,
      handleAccessError,
      showWarnDialog: false,
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
  mounted() {
    if (this.observation) {
      this.formData.observation = this.observation
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
                if (this.handleAccessError(res)) return;

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
                    msg: 'Algo salió mal. La nota no se guardó correctamente.',
                    type: 'error',
                  });
                }
              } else {
                this.store.setStatus({
                  msg: '¡La nota está guardada!',
                  type: 'success',
                });

                this.$router.push({name: 'Pets'});
              }
            })
      }
    },

    deleteObservation() {
      this.showWarnDialog = false;

      petServices.deleteObservation(this.pet_id)
          .then(res => {
            if (!res.success) {
              if (this.handleAccessError(res)) return;

              this.store.setStatus({
                msg: 'Algo salió mal. Intentalo nuevamente más tarde.',
                type: 'error',
              });
            } else {
              this.store.setStatus({
                msg: 'La nota se borró correctamente.',
                type: 'success',
              });

              this.$router.push({name: 'Pets'});
            }
          })
    }
  },
}
</script>
