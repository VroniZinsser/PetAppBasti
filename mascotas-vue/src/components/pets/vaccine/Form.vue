<template>
  <v-form
      action="vaccines/crear"
      method="post"
      ref="vaccineForm"
      @submit.prevent="createVaccine"
  >
    <InputText
        label="Nombre de la vacuna"
        v-model="formData.name"
        identifier="name"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors.name"
        required
    ></InputText>

    <InputDate
        label="Fecha"
        identifier="date"
        :loading="loading"
        :rules="[rules.obligatory, rules.date]"
        :errors="errors.date"
        :initialDate="getCurrentDate()"
        :maxDate="getCurrentDate()"
        @update-date="updateDate"
    ></InputDate>

    <v-btn type="submit" :disabled="loading">Guardar</v-btn>
  </v-form>
</template>
<script>
import InputText from "@/components/general/inputs/InputText";
import InputDate from "@/components/general/inputs/InputDate";
import vaccineService from "../../../services/vaccines";
import store from "@/store";

export default {
  name: "Form",
  components: {
    InputText,
    InputDate,
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
  methods: {
    getCurrentDate() {
      return (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10);
    },
    updateDate(date) {
      this.formData.date = date;
    },
    createVaccine() {
      if (this.$refs.vaccineForm.validate()) {
        this.loading = true;

        this.errors = {
          name: null,
          date: null,
        }

        vaccineService.create(this.formData)
            .then(res => {
              this.loading = false;

              if (!res.success) {
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
              }
            })
      }
    }
  },
}

</script>
