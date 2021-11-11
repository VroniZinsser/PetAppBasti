<template>
    <p>{{ pet.name }}</p>
</template>

<script>
export default {
  name: "PetDetailProfile",
  props: {
    pet: {
      type: Object,
      required: true
    },
  }
}
</script>