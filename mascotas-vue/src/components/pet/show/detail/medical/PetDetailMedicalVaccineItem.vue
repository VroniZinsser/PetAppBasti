<template>
  <div class="card vaccine-item">
    <span class="card-title">{{ vaccine.name }}</span>
    <span class="card-date">{{ formatDate(vaccine.date) }}</span>
  </div>

</template>
<script>
import {formatDate} from "@/helpers";

export default {
  name: "PetDetailMedicalVaccineItem",
  props: {
    vaccine: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      formatDate: formatDate,
    }
  }
}
</script>
