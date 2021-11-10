<template>
    <h2>Pet Menu Item</h2>
</template>
<script>


export default {
  name: "PetMenuItem",
  props: {
    is_active: {
      type: Boolean,
      default: false,
    },
  }
}

</script>
