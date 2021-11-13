<template>
  <div class="pet-medical-info">
    <Weight :weights="[]"></Weight>
    <Medicine :medicines="[]"></Medicine>
    <Observation></Observation>
    <Vaccine :vaccines="[]"></Vaccine>

  </div>
    
</template>

<script>
import Weight from "@/components/pets/show/medical/Weight";
import Medicine from "@/components/pets/show/medical/Medicine";
import Observation from "@/components/pets/show/medical/Observation";
import Vaccine from "@/components/pets/show/medical/Vaccine";

export default {
  name: "PetMedicalInfo",
  props: {
    pet: {
      type: Object,
      required: true
    },
  },
  components: {
    Weight,
    Medicine,
    Observation,
    Vaccine
  }
}
</script>