<template>
  <div>
    <v-form
        ref="observationForm"
        action="observaciones/crear"
        method="post"
        @submit.prevent="updateObservation"
    >
    <InputTextarea
        v-model="formData.observation"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors['data.observation']"
        label="Nota"
        identifier="observation"
        required
    />

      <button
          :disabled="loading"
          class="main-btn"
          type="submit"
      >
        Guardar
      </button>
    </v-form>

    <div class="delete-btn-container">
      <button
          :disabled="loading"
          class="delete-btn"
          @click="showWarnDialog = true"
      >
        Borrar nota
      </button>
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
import InputTextarea from "@/components/general/input/InputTextarea";
import WarnDialog from "@/components/general/notification/BaseDialogWarn";
import {handleAccessError} from "@/helpers";

export default {
  name: "ObservationForm",
  components: {
    InputTextarea,
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
