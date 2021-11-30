<template>
  <v-container>
    <h1>Tus mascotas</h1>

    <p v-if="loading">Cargando...</p>

    <div v-else>
      <List v-if="pets && pets.length > 0" :pets="pets"></List>

      <NoPet v-else></NoPet>
    </div>

    <v-btn :to="{name: 'PetAddForm'}"><span class="icon-add"></span>Agregar nueva mascota</v-btn>
  </v-container>
</template>

<script>
import List from "../../components/pets/list/List";
import petServices from "../../services/pets";
import NoPet from "@/components/pets/show/NoPet";

export default {
  name: "ShowList",
  components: {
    List,
    NoPet,
  },
  data: () => ({
    loading: true,
    pets: null,
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
