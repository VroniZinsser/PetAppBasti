<template>
  <div class="medical-container medicine">
    <div class="medical-container-header">
      <h2>Medicamentos</h2>
    </div>

    <Placeholder
        v-if="medicines.length === 0 && ownerView"
        :img_src="placeholder.img_src"
        :text="placeholder.text"
        :path_name="placeholder.cta.path_name"
        :cta_text="placeholder.cta.text"
        :pet_name="pet_name"
        :pet_id="pet_id"
    />

    <p v-else-if="medicines.length === 0 && !ownerView">No se registran medicamentos para esta mascota.</p>

    <div v-else class="medical-container-body">
      <MedicineItem
          v-for="medicine in medicines"
          :key="medicine.id"
          :medicine="medicine"
          :ownerView="ownerView"
          @delete="sendDelete"
      />

      <MedicineItemMore
          v-if="medicines.length > 3"
          :quantity="medicines.length"
          :pet_id="pet_id"
      />
    </div>
  </div>
</template>
<script>
import Placeholder from "@/components/pet/show/detail/medical/PetDetailMedicalPlaceholder";
import MedicineItem from "@/components/pet/show/detail/medical/PetDetailMedicalMedicineItem";
import MedicineItemMore from "@/components/pet/show/detail/medical/PetDetailMedicalMedicineItemMore";

export default {
  name: "PetDetailMedicalMedicine",
  components: {
    Placeholder,
    MedicineItem,
    MedicineItemMore
  },
  props: {
    medicines: {
      type: Array,
      required: true,
    },
    placeholder: {
      type: Object,
      required: true,
    },
    pet_name: {
      type: String,
      required: true,
    },
    pet_id: {
      type: Number,
      required: true,
    },
    ownerView: {
      type: Boolean,
      default: false,
    }
  },
  methods: {
    sendDelete(medicine_id) {
      this.$emit('delete', medicine_id);
    }
  }
}
</script>
