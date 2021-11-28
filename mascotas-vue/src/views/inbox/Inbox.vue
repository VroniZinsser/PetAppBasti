<template>
  <v-container fluid>
    <v-row justify="center">
        <v-img
        :src="getCompletePath('ui/construccion.png')"
        alt="Personas creando una página web"
        max-width="400"
      ></v-img>
    </v-row>
    
  </v-container>
</template>

<script>
import {PATH_IMG} from "@/constants";

export default {
  name: "Inbox",
  methods: {
    getCompletePath(path) {
      return PATH_IMG + path
    }
  }
}
</script>

<style scoped>

</style>
