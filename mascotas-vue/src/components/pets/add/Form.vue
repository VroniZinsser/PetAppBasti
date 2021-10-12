<template>
  <v-form method="post" action="mascotas/agregar" @submit.prevent="addPet">
    <v-text-field
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
        label="Especie *"
        :rules="[rules.obligatory]"
        :messages="errors.species_id ? errors.species_id[0] : ''"
        :error="errors.species_id !== null"
        :disabled="loading"
        :items="species"
        :item-text="'name'"
        :item-value="'id'"
    ></v-select>

    <fieldset>
      <legend>Sexo *</legend>

      <v-radio-group v-model="formData.sexes_id"
                     :rules="[rules.obligatory]"
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
    formData: {
      breed: 'Akita Inu',
      date_of_birth: '2021-10-06',
      name: 'Hachi',
      neutered: true,
      photo: null,
      temperament: 'Amigable',
      sexes_id: 1,
      species_id: 1,
    },
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

      petServices.addPet(this.formData)
          .then(res => {
            console.log(res)
            if (!res.success) {
              if (this.errors) {
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
              }else{
                alert("Hubo un error inesperado");
              }
            } else {
              alert("Mascota agregada con exito")
            }
          })
    }
  },
}
</script>
