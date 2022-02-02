<template>
  <v-form
      :method="this.pet ? 'PUT' : 'POST'"
      :action="this.pet ? 'mascotas/editar' : 'mascotas/agregar'"
      @submit.prevent="sendForm"
  >
    <v-text-field
        outlined
        type="text"
        required
        name="name"
        id="name"
        class="form-control"
        v-model="formData.name"
        label="Nombre *"
        :rules="[rules.obligatory]"
        :messages="errors.name ? errors.name[0] : ''"
        :error="errors.name !== null"
        :disabled="loading"
        color="#3fb094"
    ></v-text-field>

    <v-text-field
        outlined
        type="text"
        required
        name="breed"
        id="breed"
        class="form-control"
        v-model="formData.breed"
        label="Raza"
        :messages="errors.breed ? errors.breed[0] : ''"
        :error="errors.breed !== null"
        :disabled="loading"
        color="#3fb094"
    ></v-text-field>

    <v-text-field
        outlined
        type="text"
        required
        name="temperament"
        id="temperament"
        class="form-control"
        v-model="formData.temperament"
        label="Temperamento"
        :messages="errors.temperament ? errors.temperament[0] : ''"
        :error="errors.temperament !== null"
        :disabled="loading"
        color="#3fb094"
    ></v-text-field>

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

    <v-text-field
        outlined
        type="date"
        required
        name="date_of_birth"
        id="date_of_birth"
        class="form-control"
        v-model="formData.date_of_birth"
        label="Fecha de nacimiento"
        :messages="errors.date_of_birth ? errors.date_of_birth[0] : ''"
        :error="errors.date_of_birth !== null"
        :disabled="loading"
        color="#3fb094"
    ></v-text-field>

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
import petServices from "../../services/pets";
import store from "@/store";

export default {
  name: "Form",
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
