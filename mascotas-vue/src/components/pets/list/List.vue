<template>
  <ul>
    <li v-for="pet in pets" :key="pet.id">
      <v-img :src="createImgPath(pet.image.src)" :alt="pet.image.alt" width="60px"></v-img>
      <p>{{ pet.name }}</p>
      <p>{{ pet.species.name }}</p>
      <v-btn to="#"><span class="icon-show"></span>Ver detalles</v-btn>
      <v-btn to="#"><span class="icon-edit"></span>Editar</v-btn>
    </li>
  </ul>
</template>

<script>
import {createImgPath} from "@/helpers";

export default {
  name: "List",
  props: {
    pets: {
      required: true,
      type: Array,
    }
  },
  data() {
    return {
      createImgPath,
    }
  }
}
</script>

<style scoped>

</style>
