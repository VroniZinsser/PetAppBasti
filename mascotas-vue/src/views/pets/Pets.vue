<template>
  <div>
    <TitleBar title="Tus mascotas"></TitleBar>

    <Loader v-if="loading"></Loader>

    <div v-else>
      <CircleButtonLinkList :button-link-data="buttonLinkData"></CircleButtonLinkList>

      <PetMenu
          :active="activePet.id"
          :pets="pets" @show-pet="showPet"></PetMenu>

      <PetDetail :pet="activePet"></PetDetail>
    </div>
  </div>
</template>

<script>
import TitleBar from "../../components/general/layouts/TitleBar";
import Loader from "../../components/general/notifications/Loader";
import PetMenu from "../../components/pets/show/PetMenu";
import PetDetail from "../../components/pets/show/PetDetail";
import petServices from "../../services/pets";
import CircleButtonLinkList from "../../components/general/buttons/floating/CircleButtonLinkList";

export default {
  name: "Pets",
  components: {
    CircleButtonLinkList,
    TitleBar,
    PetMenu,
    PetDetail,
    Loader,
  },
  data: () => ({
    loading: true,
    pets: null,
    activePet: null,
    buttonLinkData: [
      {
        icon: 'pets',
        text: 'Mascota',
        pathName: 'PetAddForm',
        pathParams: {},
        default: true,
      },
      {
        icon: 'fitness_center',
        text: 'Peso',
        pathName: 'WeightForm',
        pathParams: {pet_id: null},
        default: false,
      },
      {
        icon: 'medication',
        text: 'Medicamento',
        pathName: 'MedicinesAddForm',
        pathParams: {pet_id: null},
        default: false,
      },
      {
        icon: 'vaccines',
        text: 'Vacuna',
        pathName: 'VaccineForm',
        pathParams: {pet_id: null},
        default: false,
      },
    ]
  }),
  mounted() {
    petServices.getOwnerPets()
        .then(res => {
          this.pets = res.data.pets;
          this.activePet = res.data.pets[0];
          this.loading = false;

          this.buttonLinkData[1].pathParams.pet_id = this.activePet.id
          this.buttonLinkData[2].pathParams.pet_id = this.activePet.id
          this.buttonLinkData[3].pathParams.pet_id = this.activePet.id
        });
  },
  methods: {
    showPet(pet_id) {
      this.activePet = this.pets.find(pet => pet.id === pet_id);
    }
  }
}
</script>

