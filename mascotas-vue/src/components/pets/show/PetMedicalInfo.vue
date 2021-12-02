<template>
  <div class="pet-medical-info">
    <Weight 
      :weights="itemsReverse(pet.weights)" 
      :placeholder="placeholder.weight" 
      :pet_name="pet.name"
      :pet_id="pet.id">
    </Weight>
    <Medicine 
      :medicines="itemsReverse(pet.medicines)" 
      :placeholder="placeholder.medicine" 
      :pet_name="pet.name"
      :pet_id="pet.id">
    </Medicine>
    <Observation 
      :observation="pet.observation" 
      :placeholder="placeholder.observation" 
      :pet_name="pet.name"
      :pet_id="pet.id">
    </Observation>
    <Vaccine 
      :vaccines="itemsReverse(pet.vaccines)" 
      :placeholder="placeholder.vaccine" 
      :pet_name="pet.name"
      :pet_id="pet.id">
    </Vaccine>
  </div>
</template>

<script>
import Weight from "@/components/pets/show/medical/Weight";
import Medicine from "@/components/pets/show/medical/Medicine";
import Observation from "@/components/pets/show/medical/Observation";
import Vaccine from "@/components/pets/show/medical/Vaccine";
import {createStaticImgPath} from "@/helpers";

export default {
  name: "PetMedicalInfo",
  props: {
    pet: {
      type: Object,
      required: true,
    },
  },
  data: function() {
    return {
      loading: true,
      medicines: [],
      vaccines: [],
      weights: [],
      placeholder: {
        vaccine: {
          img_src: createStaticImgPath('ui/no_vaccine.png'),
          text: `Agregá las vacunas que :petName ya ha obtenido.`,
          cta: {
              path_name: 'VaccineForm',
              text: 'Agregar vacuna'
          }
        },
        weight: {
          img_src: createStaticImgPath('ui/no_weight.png'),
          text: `¿Cuánto pesa :petName? Anotalo regularmente para llevar un mejor control sobre su salud.`,
          cta: {
              path_name: 'WeightForm',
              text: 'Agregar peso'
          }
        },
        medicine: {
          img_src: createStaticImgPath('ui/no_medicine.png'),
          text: `Agregá medicamentos actuales o del pasado para el registro de medicación de :petName.`,
          cta: {
              path_name: 'MedicinesAddForm',
              text: 'Agregar medicamento'
          }
        },
        observation: {
          img_src: createStaticImgPath('ui/no_observation.png'),
          text: `Aquí tenés espacio para anotar observaciones, dudas o comentarios.`,
          cta: {
              path_name: 'ObservationForm',
              text: 'Agregar nota'
          }
        }    
      },
    }
  },
  components: {
    Weight,
    Medicine,
    Observation,
    Vaccine
  },
  methods: {
    // TODO: Instead of reverse items, sort them by date (newest first)
    itemsReverse(items) {
      return [...items].reverse()
    }
  },
}
</script>
