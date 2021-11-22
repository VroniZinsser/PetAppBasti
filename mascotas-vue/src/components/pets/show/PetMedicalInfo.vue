<template>
  <div class="pet-medical-info">
    <Weight :weights="weights" :placeholder="placeholder.weight" :pet_name="pet.name"></Weight>
    <Medicine :medicines="medicines" :placeholder="placeholder.medicine" :pet_name="pet.name"></Medicine>
    <Observation :observation="pet.observation" :placeholder="placeholder.observation" :pet_name="pet.name"></Observation>
    <Vaccine :vaccines="vaccines" :placeholder="placeholder.vaccine" :pet_name="pet.name"></Vaccine>
  </div>
</template>

<script>
import Weight from "@/components/pets/show/medical/Weight";
import Medicine from "@/components/pets/show/medical/Medicine";
import Observation from "@/components/pets/show/medical/Observation";
import Vaccine from "@/components/pets/show/medical/Vaccine";
import petService from "@/services/pets";
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
        text: `¿Cuánto pesa :petName? Si lo anotás regularmente podés llevar un mejor control sobre su salud.`,
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
  mounted() {
    this.loadMedicalInfo();
  },
  watch: {
    pet: function() {
      this.loadMedicalInfo();
    }
  },
  methods: {
    loadMedicalInfo() {
      Promise.all([
        petService.getVaccines(this.pet.id),
        petService.getWeights(this.pet.id),
        petService.getMedicines(this.pet.id),
      ]).then(res => {
        this.vaccines = res[0].data.vaccines;
        this.weights = res[1].data.weights;
        this.medicines = res[2].data.medicines;
        this.loading = false;
      })
    },
  }
}
</script>
