<template>
  <div class="pet-medical-info">
    <Weight 
      :weights="pet.weights" 
      :placeholder="placeholder.weight" 
      :pet_name="pet.name">
    </Weight>
    <Medicine 
      :medicines="pet.medicines" 
      :placeholder="placeholder.medicine" 
      :pet_name="pet.name">
    </Medicine>
    <Observation 
      :observation="pet.observation" 
      :placeholder="placeholder.observation" 
      :pet_name="pet.name">
    </Observation>
    <Vaccine 
      :vaccines="pet.vaccines" 
      :placeholder="placeholder.vaccine" 
      :pet_name="pet.name">
    </Vaccine>
  </div>
</template>

<script>
import Weight from "@/components/pets/show/medical/Weight";
import Medicine from "@/components/pets/show/medical/Medicine";
import Observation from "@/components/pets/show/medical/Observation";
import Vaccine from "@/components/pets/show/medical/Vaccine";
import {createImgPath} from "@/helpers";

export default {
  name: "PetMedicalInfo",
  props: {
    pet: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    loading: true,
    medicines: [],
    vaccines: [],
    weights: [],
    placeholder: {
      vaccine: {
        img_src: createImgPath('ui/no_vaccine.png'),
        text: `Agregá las vacunas que :petName ya ha obtenido.`,
        cta: {
            url: '#',
            text: 'Agregar vacuna'
        }
      },
      weight: {
        img_src: createImgPath('ui/no_vaccine.png'),
        text: `¿Cuánto pesa :petName? Anotalo regularmente para llevar un mejor control sobre su salud.`,
        cta: {
            url: '#',
            text: 'Agregar peso'
        }
      },
      medicine: {
        img_src: createImgPath('ui/no_medicine.png'),
        text: `Agregá medicamentos actuales o del pasado para el registro de medicación de :petName.`,
        cta: {
            url: '#',
            text: 'Agregar medicamento'
        }
      },
      observation: {
        img_src: createImgPath('ui/no_vaccine.png'),
        text: `Aquí tenés espacio para anotar observaciones, dudas o comentarios.`,
        cta: {
            url: '#',
            text: 'Agregar nota'
        }
      }    
    },
  }),
  components: {
    Weight,
    Medicine,
    Observation,
    Vaccine
  },
}
</script>
