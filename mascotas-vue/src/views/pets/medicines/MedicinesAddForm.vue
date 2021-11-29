<template>
  <v-container fluid>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />
    <h1>Agregar un medicamento</h1>

    <p v-if="loading">Cargando...</p>

    <Form v-else 
      :hours="hours"
      :pet_id="$route.params.pet_id">
    </Form>
  </v-container>
</template>

<script>

import Form from '@/components/pets/medicines/add/Form';
import medicineServices from "@/services/medicines";
import BaseNotification from "@/components/general/notifications/BaseNotification";
import store from "@/store";

export default {
  name: "MedicinesAddForm",
  components: {
    Form,
    BaseNotification
  },
  data: function (){
    return {
      loading: true,
      hours: [],
      store,
    }
  },
  mounted() {
    medicineServices.addForm()
        .then(res => {
          this.hours = res.data.hours;
          this.loading = false;
        })
  }
}
</script>

<style scoped>

</style>
