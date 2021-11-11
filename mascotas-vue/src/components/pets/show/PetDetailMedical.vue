<template>
    <p>{{ pet.name }}</p>
</template>

<script>
export default {
  name: "PetDetailMedical",
  props: {
    pet: {
      type: Object,
      required: true
    },
  }
}
</script>