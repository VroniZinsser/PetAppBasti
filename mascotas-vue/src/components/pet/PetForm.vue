<template>
  <v-form
      ref="petForm"
      :method="formMethod"
      :action="formAction"
      @submit.prevent="sendForm"
  >
    <InputText
        v-model="formData.name"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors.name"
        label="Nombre"
        identifier="name"
        required
    />

    <InputText
        v-model="formData.breed"
        :loading="loading"
        :errors="errors.breed"
        label="Raza"
        identifier="breed"
    />

    <InputText
        v-model="formData.temperament"
        :loading="loading"
        :errors="errors.temperament"
        label="Temperamento"
        identifier="temperament"
        hint="Actitudes de la mascota como tranquilo, mimoso, agresivo"
    />

    <v-checkbox
        v-model="formData.neutered"
        id="neutered"
        :messages="errors.neutered ? errors.neutered[0] : ''"
        :error="errors.neutered !== null"
        :disabled="loading"
        name="neutered"
        class="form-control"
        label="Castrado(a)"
        color="#3fb094"
    />

    <InputDate
        :loading="loading"
        :rules="[rules.obligatory, rules.date]"
        :errors="errors.date"
        :initialDate="initialDate"
        :maxDate="getCurrentDate()"
        label="Fecha de nacimiento"
        identifier="date_of_birth"
        @update-date="updateDate"
    />

    <v-select
        v-model="formData.species_id"
        id="species_id"
        :rules="[rules.obligatory]"
        :messages="errors.species_id ? errors.species_id[0] : ''"
        :error="errors.species_id !== null"
        :disabled="loading"
        :items="species"
        :item-text="'name'"
        :item-value="'id'"
        name="species_id"
        class="form-control"
        label="Especie *"
        color="#3fb094"
        outlined
        required
    />

    <fieldset>
      <legend>Sexo *</legend>

      <v-radio-group
          v-model="formData.sex_id"
          :rules="[rules.obligatory]"
          :messages="errors.sex_id ? errors.sex_id[0] : ''"
          :error="errors.sex_id !== null"
      >
        <v-radio
            v-for="i in sexes"
            :key="i.id"
            :label="`${i.name}`"
            :value="i.id"
            :disabled="loading"
            color="#3fb094"
        />
      </v-radio-group>
    </fieldset>

    <img
        v-if="formData.photo"
        class="img-preview"
        :src="formData.photo"
        alt="Preview de la imagen"
    />

    <v-file-input
        ref="photo"
        v-model="photo"
        :messages="errors.photo ? errors.photo[0] : ''"
        :error="errors.photo !== null"
        :disabled="loading"
        accept="image/*"
        prepend-icon="mdi-camera"
        truncate-length="15"
        label="Foto de la mascota"
        color="#3fb094"
        outlined
        show-size
        @change="handleFileUpload"
    />

    <button class="main-btn" type="submit" :disabled="loading">Guardar</button>
  </v-form>
</template>

<script>
import InputDate from "@/components/general/input/InputDate";
import InputText from "@/components/general/input/InputText";
import petServices from "@/services/pets";
import store from "@/store";
import {getCurrentDate} from "@/helpers";
import {handleAccessError} from "@/helpers";

export default {
  name: "PetForm",
  components: {
    InputDate,
    InputText,
  },
  props: {
    sexes: {
      type: Array,
      required: true,
    },
    species: {
      type: Array,
      required: true,
    },
    pet: {
      type: Object
    }
  },
  data: () => ({
    loading: false,
    photo: null,
    store,
    getCurrentDate,
    handleAccessError,
    formData: {
      breed: null,
      date_of_birth: null,
      name: null,
      neutered: null,
      photo: null,
      temperament: null,
      sex_id: null,
      species_id: null,
    },
    errors: {
      breed: null,
      date_of_birth: null,
      name: null,
      neutered: null,
      photo: null,
      temperament: null,
      sex_id: null,
      species_id: null,
    },
    rules: {
      obligatory: v => !!v || 'Este campo es obligatorio.',
      date: value => {
        const pattern = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/;
        return pattern.test(value) || 'Por favor, ingresá una fecha válida (31/01/2021)'
      },
    }
  }),
  computed: {
    initialDate() {
      return this.pet ? this.pet.date_of_birth : null;
    },

    formMethod(){
      return this.pet ? 'PUT' : 'POST';
    },

    formAction(){
      return this.pet ? 'mascotas/editar' : 'mascotas/agregar';
    },
  },
  mounted() {
    if (this.pet) {
      this.formData = {
        breed: null,
        date_of_birth: null,
        name: null,
        neutered: this.pet.neutered === 1,
        photo: null,
        temperament: null,
        sex_id: this.pet.sexes_id,
        species_id: null,
        ...this.pet
      }
    }

    if (!this.formData.neutered) {
      this.formData.neutered = false
    }
  },
  methods: {

    /**
     * Transforms the image uploaded by the user to base64 and saves it in the photo property of formData
     */
    handleFileUpload() {
      const reader = new FileReader();

      reader.addEventListener('load', () => {
        this.formData.photo = reader.result;
      });

      reader.readAsDataURL(this.photo);
    },

    /**
     * Submit the form and check if it is to edit the mascot or to create a new one.
     */
    sendForm() {
      if (this.$refs.petForm.validate()) {
        this.loading = true;

        this.errors = {
          breed: null,
          date_of_birth: null,
          name: null,
          neutered: false,
          photo: null,
          temperament: null,
          sex_id: null,
          species_id: null,
        }


        if (!this.pet) {
          petServices.addPet(this.formData)
              .then(res => {
                this.loading = false;
                if (!res.success) {
                  if (this.handleAccessError(res)) return;
                  if (res.errors) {
                    this.errors = {
                      breed: null,
                      date_of_birth: null,
                      name: null,
                      neutered: null,
                      photo: null,
                      temperament: null,
                      sex_id: null,
                      species_id: null,
                      ...res.errors
                    }

                    this.store.setStatus({
                      msg: "Por favor corregí los datos del formulario.",
                      type: 'warning',
                    });
                  } else {
                    this.store.setStatus({
                      msg: 'Algo salió mal. Tu mascota no se guardó.',
                      type: 'error',
                    });
                  }
                } else {
                  this.store.setStatus({
                    msg: '¡Muy bien! Tu mascota está guardada.',
                    type: 'success',
                  });

                  this.$router.push({name: 'Pets'});
                }
              })
        } else {
          petServices.updatePet(this.formData, this.pet.id)
              .then(res => {
                this.loading = false;
                if (!res.success) {
                  if (this.handleAccessError(res)) return;
                  if (res.errors) {
                    this.errors = {
                      breed: null,
                      date_of_birth: null,
                      name: null,
                      neutered: null,
                      photo: null,
                      temperament: null,
                      sex_id: null,
                      species_id: null,
                      ...res.errors
                    }

                    this.store.setStatus({
                      msg: "Por favor corregí los datos del formulario.",
                      type: 'warning',
                    });
                  } else {
                    this.store.setStatus({
                      msg: 'Algo salió mal. No se guardaron los cambios.',
                      type: 'error',
                    });
                  }
                } else {
                  this.store.setStatus({
                    msg: '¡Muy bien! Cambios guardados con éxito.',
                    type: 'success',
                  });

                  this.$router.push({name: 'Pets'});
                }
              })
        }
      }
    },
    updateDate(date) {
      this.formData.date_of_birth = date;
    }
  },
}
</script>
