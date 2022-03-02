<template>
  <v-form
      :method="this.pet ? 'PUT' : 'POST'"
      :action="this.pet ? 'mascotas/editar' : 'mascotas/agregar'"
      ref="petForm"
      @submit.prevent="sendForm"
  >
    <InputText
        label="Nombre"
        v-model="formData.name"
        identifier="name"
        :loading="loading"
        :rules="[rules.obligatory]"
        :errors="errors.name"
        required
    ></InputText>
    
    <InputText
        label="Raza"
        v-model="formData.breed"
        identifier="breed"
        :loading="loading"
        :errors="errors.breed"
    ></InputText>
    
    <InputText
        label="Temperamento"
        v-model="formData.temperament"
        identifier="temperament"
        :loading="loading"
        :errors="errors.temperament"
        hint="Actitudes de la mascota como tranquilo, mimoso, agresivo"
    ></InputText>

    <v-checkbox
        name="neutered"
        id="neutered"
        class="form-control"
        v-model="formData.neutered"
        label="Castrado(a)"
        :messages="errors.neutered ? errors.neutered[0] : ''"
        :error="errors.neutered !== null"
        :disabled="loading"
        color="#3fb094"
    ></v-checkbox>

    <InputDate
        label="Fecha de nacimiento"
        identifier="date_of_birth"
        :loading="loading"
        :rules="[rules.obligatory, rules.date]"
        :errors="errors.date"
        :initialDate="initialDate"
        :maxDate="getCurrentDate()"
        @update-date="updateDate"
    ></InputDate>

    <v-select
        outlined
        required
        name="species_id"
        id="species_id"
        class="form-control"
        v-model="formData.species_id"
        label="Especie *"
        :rules="[rules.obligatory]"
        :messages="errors.species_id ? errors.species_id[0] : ''"
        :error="errors.species_id !== null"
        :disabled="loading"
        :items="species"
        :item-text="'name'"
        :item-value="'id'"
        color="#3fb094"
    ></v-select>

    <fieldset>
      <legend>Sexo *</legend>

      <v-radio-group
          v-model="formData.sex_id"
          :rules="[rules.obligatory]"
          :messages="errors.sex_id ? errors.sex_id[0] : ''"
          :error="errors.sex_id !== null">

        <v-radio
            v-for="i in sexes"
            :key="i.id"
            :label="`${i.name}`"
            :value="i.id"
            :disabled="loading"
            color="#3fb094"
        ></v-radio>
      </v-radio-group>
    </fieldset>

    <img class="img-preview" :src="formData.photo" alt="Preview de la imagen" v-if="formData.photo">

    <v-file-input
        outlined
        v-model="photo"
        ref="photo"
        show-size
        accept="image/*"
        prepend-icon="mdi-camera"
        truncate-length="15"
        @change="handleFileUpload"
        label="Foto de la mascota"
        :messages="errors.photo ? errors.photo[0] : ''"
        :error="errors.photo !== null"
        :disabled="loading"
        color="#3fb094"
    ></v-file-input>

    <button class="main-btn" type="submit" :disabled="loading">Guardar</button>
  </v-form>
</template>

<script>
import InputDate from "@/components/general/input/InputDate";
import InputText from "@/components/general/input/InputText";
import petServices from "../../services/pets";
import store from "@/store";
import {getCurrentDate} from "@/helpers";
import { handleAccessError } from "@/helpers";

export default {
  name: "PetForm",
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
  components: {
    InputDate,
    InputText,
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
  computed: {
    initialDate(){
      return this.pet ? this.pet.date_of_birth : null;
    }
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
  }
}
</script>
