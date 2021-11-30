<template>
  <div>
    <TitleBar title="Tus mascotas"></TitleBar>

    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <Loader v-if="loading"></Loader>

    <div v-else>
      <div v-if="pets !== null && pets.length > 0">
        <PetMenu
            :active="activePet.id"
            :pets="pets" @show-pet="showPet"></PetMenu>

        <PetDetail :pet="activePet" @deleted="refreshPets"></PetDetail>
      </div>

      <NoPet v-else></NoPet>
    </div>
  </div>
</template>

<script>
import TitleBar from "../../components/general/layouts/TitleBar";
import Loader from "../../components/general/notifications/Loader";
import PetMenu from "../../components/pets/show/PetMenu";
import PetDetail from "../../components/pets/show/PetDetail";
import petServices from "../../services/pets";
import NoPet from "@/components/pets/show/NoPet";
import BaseNotification from "../../components/general/notifications/BaseNotification";
import store from "../../store";

export default {
  name: "Pets",
  components: {
    BaseNotification,
    TitleBar,
    PetMenu,
    PetDetail,
    Loader,
    NoPet,
  },
  data: () => ({
    loading: true,
    pets: null,
    activePet: null,
    store
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
    },

    refreshPets() {
      this.loading = true;

      petServices.getOwnerPets()
          .then(res => {
            this.pets = res.data.pets;
            this.activePet = res.data.pets[0];
            this.loading = false;
          });
    }
  }
}
</script>

