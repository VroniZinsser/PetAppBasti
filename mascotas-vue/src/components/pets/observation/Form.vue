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
    ></Textarea>

    <button class="main-btn" type="submit" :disabled="loading">Guardar</button>
  </v-form>
  <button class="delete-btn" :disabled="loading" @click="showWarnDialog = true" >Borrar nota</button>
  <WarnDialog
    :showDialog="showWarnDialog" 
    dialogTitle="Borrar nota"
    dialogText="Podrás escribir una nueva nota cuando quieras"
    acceptButtonText="Borrar"

    @cancle="showWarnDialog = false"
    @accept="deleteObservation()"
  />
</div>
</template>

<script>
import Textarea from "@/components/general/inputs/Textarea";
import WarnDialog from "@/components/general/notifications/WarnDialog";
import petServices from "../../../services/pets";
import store from "@/store";

export default {
  name: "Form",
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
      petServices.deleteObservation()
        .then(res => {
          if (!res.success) {
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
  mounted() {
    if(this.observation){
      this.formData.observation = this.observation
    }
  }
}
</script>
