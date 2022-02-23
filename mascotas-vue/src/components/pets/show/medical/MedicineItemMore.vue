<template>
  <div class="card more">
    <router-link :to="{name: 'MedicineList', params: {pet_id : pet_id}}">
      <div class="inner">
        <p><span class="sr-only">Icono </span><span class="material-icons">medication</span></p>
        <p>Ver todos <span>({{ quantity }})</span></p>
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "MedicineItem",
  props: {
    quantity: {
      type: Number,
      required: true
    },
    pet_id: {
      type: Number,
      required: true,
    }
  },
}
</script>
