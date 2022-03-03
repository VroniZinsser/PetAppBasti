<template>
  <ul class="medical-list justify-space-around">
    <MedicineItem
        v-for="medicine in sortedArray"
        :key="medicine.id"
        :medicine="medicine"
        @delete="sendDelete"
    />
  </ul>
</template>

<script>
import MedicineItem from "@/components/pet/show/detail/medical/PetDetailMedicalMedicineItem";

export default {
  name: "MedicineList",
  components: {MedicineItem},
  props: {
    medicines: {
      type: Array,
      required: true,
    }
  },
  computed: {
    sortedArray() {
      let medicines = this.medicines;

      return medicines.sort((a, b) => (a.end_date < b.end_date) ? 1 : -1);
    }
  },
  methods: {
    sendDelete(medicine_id) {
      this.$emit('delete', medicine_id);
    }
  },
}
</script>