<template>
  <v-container fluid>
    <TitleBar title="Tus mascotas"></TitleBar>

    <Loader v-if="loading"></Loader>

    <div v-else>
        <PetMenu 
        :active="activePet.id"
        :pets="pets" @show-pet="showPet"></PetMenu>

        <PetDetail :pet="activePet"></PetDetail>
    </div>
  </v-container>
</template>

<script>
import TitleBar from "../../components/general/layouts/TitleBar";
import Loader from "../../components/general/notifications/Loader";
import PetMenu from "../../components/pets/show/PetMenu";
import PetDetail from "../../components/pets/show/PetDetail";
import petServices from "../../services/pets";

export default {
  name: "Pets",
  components: {
    TitleBar,
    PetMenu,
    PetDetail,
    Loader,
  },
  data: () => ({
    loading: true,
    pets: null,
    activePet: null,
  }),
  mounted() {
    petServices.getOwnerPets()
        .then(res => {
          this.pets = res.data.pets;
          this.activePet = res.data.pets[0];
          this.loading = false;
        });
  },
  methods: {
    showPet(pet_id) {
      this.activePet = this.pets.find(pet => pet.id === pet_id);
    }
  }
}
</script>

