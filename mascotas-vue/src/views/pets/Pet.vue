<template>
  <v-container fluid>
    <TitleBar title="Tus mascotas"></TitleBar>

    <p v-if="loading">Cargando...</p>

    <div v-else>
      <PetMenu
          :active="parseInt($route.params.pet_id)"
          :pets="pets"></PetMenu
      >

      <PetDetail :pet="findPet(parseInt($route.params.pet_id))"></PetDetail>
    </div>
  </v-container>
</template>

<script>
import TitleBar from "../../components/general/layouts/TitleBar";
import PetMenu from "../../components/pets/show/PetMenu";
import PetDetail from "../../components/pets/show/PetDetail";
import petServices from "../../services/pets";

export default {
  name: "Pet",
  components: {
    TitleBar,
    PetMenu,
    PetDetail,
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
  },
  methods: {
    findPet($pet_id) {
      return this.pets.find(pet => pet.id === $pet_id);
    },
  },
}
</script>

