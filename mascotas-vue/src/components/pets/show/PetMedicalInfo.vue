<template>
  <div class="pet-medical-info">
    <Weight :weights="weights"></Weight>
    <Medicine :medicines="medicines"></Medicine>
    <Observation :observation="pet.observation"></Observation>
    <Vaccine :vaccines="vaccines"></Vaccine>

  </div>
</template>

<script>
import Weight from "@/components/pets/show/medical/Weight";
import Medicine from "@/components/pets/show/medical/Medicine";
import Observation from "@/components/pets/show/medical/Observation";
import Vaccine from "@/components/pets/show/medical/Vaccine";
import petService from "@/services/pets";

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
    weights: []
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
      

    }
  }
}
</script>
