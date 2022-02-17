<template>
  <v-form
      :action="weight ? 'pesos/editar' : 'pesos/crear'"
      method="post"
      ref="weightForm"
      @submit.prevent="sendForm"
  >
    <InputText
        label="Peso en gramos"
        v-model="formData.weight"
        identifier="weight"
        :loading="loading"
        :rules="[rules.obligatory, rules.numeric]"
        :errors="errors.weight"
        required
        type="number"
    ></InputText>

    <InputDate
        label="Fecha"
        identifier="date"
        :loading="loading"
        :rules="[rules.obligatory, rules.date]"
        :errors="errors.date"
        :initialDate="initialDate"
        :maxDate="getCurrentDate()"
        @update-date="updateDate"
    ></InputDate>

    <button class="main-btn" type="submit" :disabled="loading">Agregar</button>
  </v-form>
</template>
<script>
import InputText from "@/components/general/inputs/InputText";
import InputDate from "@/components/general/inputs/InputDate";
import weightService from "../../../services/weights";
import store from "@/store";

export default {
  name: "Form",
  components: {
    InputText,
    InputDate
  },
  props: {
    pet_id: {
      type: [String, Number],
      required: true,
    },
    weight: {
      type: Object,
      default: null,
    },
  },
  data: function () {
    return {
      loading: false,
      store,
      formData: {
        weight: null,
        date: this.getCurrentDate(),
        pet_id: this.pet_id
      },
      editingDate: null,

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

    sendForm() {
      if (this.$refs.weightForm.validate()) {
        this.loading = true;

        this.errors = {
          date: null,
          weight: null,
        }

        if (!this.editing) {
          weightService.create(this.formData)
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
                      date: null,
                      weight: null,
                      ...res.errors
                    }
                    this.store.setStatus({
                      msg: "Por favor corregí los datos del formulario.",
                      type: 'warning',
                    });
                  } else {
                    this.store.setStatus({
                      msg: 'Algo salió mal. El peso no se guardó correctamente.',
                      type: 'error',
                    });
                  }
                } else {
                  this.store.setStatus({
                    msg: '¡El nuevo peso está guardado!',
                    type: 'success',
                  });
                  this.$router.push({name: 'Pets'});
                }
              })
        } else {
          weightService.update(this.formData, this.weight_id)
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
                      date: null,
                      weight: null,
                      ...res.errors
                    }
                    this.store.setStatus({
                      msg: "Por favor corregí los datos del formulario.",
                      type: 'warning',
                    });
                  } else {
                    this.store.setStatus({
                      msg: 'Algo salió mal. El peso no se editó correctamente.',
                      type: 'error',
                    });
                  }
                } else {
                  this.store.setStatus({
                    msg: '¡Se editó el peso con éxito!',
                    type: 'success',
                  });
                  this.$router.push({name: 'WeightList'});
                }
              })
        }
      }
    }
  },
  computed: {
    initialDate(){
      return this.weight ? this.weight.date : this.getCurrentDate();
    }
  },
  mounted() {
    console.log(this.weight);
    if (this.weight) {
      this.formData.weight = this.weight.weight;
      this.formData.date = this.weight.date;
    }
  }
}
</script>
