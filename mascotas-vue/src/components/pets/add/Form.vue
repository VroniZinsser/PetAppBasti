<template>
  <v-form method="post" action="mascotas/agregar" @submit.prevent="addPet">
    <v-text-field
        type="text"
        required
        name="name"
        id="name"
        class="form-control"
        v-model="formData.name"
        label="Nombre"
        :rules="[rules.obligatory]"
        :messages="errors.name ? errors.name[0] : ''"
        :error="errors.name !== null"
        :disabled="loading"
    ></v-text-field>

    <v-text-field
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
    ></v-text-field>

    <v-text-field
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
    ></v-checkbox>

    <v-text-field
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
    ></v-text-field>

    <v-select
        required
        name="species_id"
        id="species_id"
        class="form-control"
        v-model="formData.species_id"
        label="Especie"
        :rules="[rules.obligatory]"
        :messages="errors.species_id ? errors.species_id[0] : ''"
        :error="errors.species_id !== null"
        :disabled="loading"
        :items="species"
        :item-text="'name'"
        :item-value="'id'"
    ></v-select>

    <fieldset>
      <legend>Sexo</legend>

      <v-radio-group v-model="formData.sexes_id"
                     :messages="errors.sexes_id ? errors.sexes_id[0] : ''"
                     :error="errors.sexes_id !== null">
        <v-radio
            v-for="i in sexes"
            :key="i.id"
            :label="`${i.name}`"
            :value="i.id"
            :disabled="loading"
        ></v-radio>
      </v-radio-group>
    </fieldset>

    <img :src="formData.photo" alt="Preview de la imagen" v-if="formData.photo">

    <v-file-input
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
    ></v-file-input>

    <v-btn
        type="submit"
    >Agregar
    </v-btn>
  </v-form>
</template>

<script>
import petServices from "../../../services/pets";

export default {
  name: "Form",
  props: {
    loading: {
      type: Boolean,
      required: true,
    },
    sexes: {
      type: Array,
      required: true,
    },
    species: {
      type: Array,
      required: true,
    },
  },
  data: () => ({
    photo: null,
    /*formData: {
      breed: null,
      date_of_birth: null,
      name: null,
      neutered: false,
      photo: null,
      temperament: null,
      sexes_id: null,
      species_id: null,
    },*/
    formData:
        {
          "breed": "asd",
          "date_of_birth": "2021-09-29",
          "name": "asd",
          "neutered": true,
          "photo": "data:image/png;base64,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... (10024 total length)",
          "temperament": "asd",
          "sexes_id": 412,
          "species_id": 3
        }
    ,
    errors: {
      breed: null,
      date_of_birth: null,
      name: null,
      neutered: null,
      photo: null,
      temperament: null,
      sexes_id: null,
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

    addPet() {
      // this.loading = true;

      this.errors = {
        breed: null,
        date_of_birth: null,
        name: null,
        neutered: null,
        photo: null,
        temperament: null,
        sexes_id: null,
        species_id: null,
      }

      const pet = this.formData;

      if (pet.name == null) {
        this.errors.name = ["El campo nombre es obligatorio"];
        return;
      }

      if (pet.species_id == null) {
        this.errors.species_id = ["La especie es obligatoria"];
        return;
      }

      petServices.addPet(pet)
          .then(res => {
            if (res.errors) {
              this.errors = {
                breed: null,
                date_of_birth: null,
                name: null,
                neutered: null,
                photo: null,
                temperament: null,
                sexes_id: null,
                species_id: null,
                ...res.errors
              }
            } else {
              console.log(res)
            }
          })
    }
  },
}
</script>
