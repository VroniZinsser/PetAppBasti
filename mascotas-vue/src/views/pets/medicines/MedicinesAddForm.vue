<template>
  <v-container fluid>
    <h1>Agregar un medicamento</h1>

    <p v-if="loading">Cargando...</p>

    <Form v-else :hours="hours"></Form>
  </v-container>
</template>

<script>

import Form from '@/components/pets/medicines/add/Form';
import medicineServices from "@/services/medicines";

export default {
  name: "MedicinesAddForm",
  components: {Form},
  data: function (){
    return {
      loading: true,
      hours: [],
    }
  },
  mounted() {
    medicineServices.addForm()
        .then(res => {
          this.hours = res.data;
          this.loading = false;
        })
  }
}
</script>

<style scoped>

</style>
