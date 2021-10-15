<template>
  <ul>
    <li v-for="pet in pets" :key="pet.id">
      <v-img :src="getCompletePath(pet.image.src)" :alt="pet.image.alt" width="60px"></v-img>
      <p>{{ pet.name }}</p>
      <p>{{ pet.species.name }}</p>
    </li>
  </ul>
</template>

<script>
import {PATH_IMG} from "../../../constants";

export default {
  name: "List",
  props: {
    pets: {
      required: true,
      type: Array,
    }
  },
  methods: {
    getCompletePath(path) {
      return PATH_IMG + path
    }
  }
}
</script>

<style scoped>

</style>
