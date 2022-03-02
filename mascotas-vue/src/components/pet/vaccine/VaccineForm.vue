<template>
  <v-form
      :action="vaccine ? 'vacunas/editar' : 'vacunas/crear'"
      method="post"
      ref="vaccineForm"
      @submit.prevent="sendForm"
  >
    <InputText
        label="Nombre de la vacuna"
        v-model="formData.name"
        identifier="name"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors.name"
        required
    />

    <InputDate
        label="Fecha"
        identifier="date"
        :loading="loading"
        :rules="[rules.obligatory, rules.date]"
        :errors="errors.date"
        :initialDate="initialDate"
        :maxDate="getCurrentDate()"
        @update-date="updateDate"
    />

    <button class="main-btn" type="submit" :disabled="loading">{{ vaccine ? "Guardar cambios" : "Agregar" }}</button>
  </v-form>
</template>

<script>
import InputText from "@/components/general/input/InputText";
import InputDate from "@/components/general/input/InputDate";
import store from "@/store";
import vaccineService from "@/services/vaccines";
import {handleAccessError} from "@/helpers";

export default {
  name: "VaccineForm",
  components: {
    InputText,
    InputDate,
  },
  props: {
    pet_id: {
      type: [String, Number],
      required: true,
    },
    vaccine: {
      type: Object,
      default: null,
    },
  },
  data: function () {
    return {
      loading: false,
      store,
      handleAccessError,
      formData: {
        name: null,
        date: this.getCurrentDate(),
        pet_id: this.pet_id,
      },
      errors: {
        name: null,
        date: null,
      },
      rules: {
        obligatory: v => !!v || 'Este campo es obligatorio.',
        date: value => {
          const pattern = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/;
          return pattern.test(value) || 'Por favor, ingresá una fecha válida (31/01/2021)';
        },
      }
    }
  },
  computed: {
    initialDate() {
      return this.vaccine ? this.vaccine.date : this.getCurrentDate();
    }
  },
  mounted() {
    if (this.vaccine) {
      this.formData.name = this.vaccine.name;

      this.formData.date = this.vaccine.date;
    }
  },
  methods: {
    getCurrentDate() {
      return (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10);
    },

    updateDate(date) {
      this.formData.date = date;
    },

    sendForm() {
      if (this.$refs.vaccineForm.validate()) {
        this.loading = true;

        this.errors = {
          name: null,
          date: null,
        }

        if (!this.vaccine) {
          vaccineService.create(this.formData)
              .then(res => {
                this.loading = false;

                if (!res.success) {
                  if (this.handleAccessError(res)) return;

                  if (res.errors && res.errors.pet_id) {
                    this.store.setStatus({
                      msg: 'La mascota no existe.',
                      type: 'error',
                    });
                  } else if (res.errors) {
                    this.errors = {
                      name: null,
                      date: null,
                      ...res.errors
                    }

                    this.store.setStatus({
                      msg: "Por favor corregí los datos del formulario.",
                      type: 'warning',
                    });
                  } else {
                    this.store.setStatus({
                      msg: 'Algo salió mal. La vacuna no se guardó correctamente.',
                      type: 'error',
                    });
                  }
                } else {
                  this.store.setStatus({
                    msg: '¡La nueva vacuna está guardada!',
                    type: 'success',
                  });

                  this.$router.back();
                }
              })
        } else {
          vaccineService.update(this.formData, this.vaccine.id)
              .then(res => {
                this.loading = false;

                if (!res.success) {
                  if (this.handleAccessError(res)) return;

                  if (res.errors && res.errors.pet_id) {
                    this.store.setStatus({
                      msg: 'La mascota no existe.',
                      type: 'error',
                    });
                  } else if (res.errors) {
                    this.errors = {
                      name: null,
                      date: null,
                      ...res.errors
                    }

                    this.store.setStatus({
                      msg: "Por favor corregí los datos del formulario.",
                      type: 'warning',
                    });
                  } else {
                    this.store.setStatus({
                      msg: 'Algo salió mal. La vacuna no se editó correctamente.',
                      type: 'error',
                    });
                  }
                } else {
                  this.store.setStatus({
                    msg: '¡La vacuna se editó con éxito!',
                    type: 'success',
                  });

                  this.$router.back();
                }
              })
        }
      }
    }
  },
}
</script>
