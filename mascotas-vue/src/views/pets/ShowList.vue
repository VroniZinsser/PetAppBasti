<template>
  <v-container>
    <h1>Tus mascotas</h1>

    <List></List>
  </v-container>
</template>

<script>
import List from "../../components/pets/list/List";

export default {
  name: "ShowList",
  components: {List}
}
</script>

<style scoped>

</style>
