<template>
    <h2>Pet Detail</h2>
</template>
<script>


export default {
  name: "PetDetail",
  props: {
    pets_id: {
      type: String,
      required: true
    },
  }
}

</script>
