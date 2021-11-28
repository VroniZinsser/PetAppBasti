<template>
  <v-container fluid>
    <v-img
      :src="getCompletePath('ui/construccion.svg')"
    ></v-img>
  </v-container>
</template>

<script>
import {PATH_IMG} from "@/constants";

export default {
  name: "Schedule",
  methods: {
    getCompletePath(path) {
      return PATH_IMG + path
    }
  }
}
</script>

<style scoped>

</style>
