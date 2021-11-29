<template>
  <v-container>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />
    <h1>Tus mascotas</h1>

    <p v-if="loading">Cargando...</p>

    <div v-else>
      <List v-if="pets" :pets="pets"></List>

      <p v-else>No agregaste ninguna mascota aun</p>
    </div>

    <v-btn :to="{name: 'PetAddForm'}"><span class="icon-add"></span>Agregar nueva mascota</v-btn>
  </v-container>
</template>

<script>
import List from "../../components/pets/list/List";
import petServices from "../../services/pets";
import BaseNotification from "@/components/general/notifications/BaseNotification"
import store from "@/store"

export default {
  name: "ShowList",
  components: {
    List,
    BaseNotification,  
  },
  data: () => ({
    loading: true,
    pets: null,
    store,
  }),
  mounted() {
    petServices.getOwnerPets()
        .then(res => {
          this.pets = res.data.pets;
          this.loading = false;
        });
  }
}
</script>

<style scoped>

</style>
