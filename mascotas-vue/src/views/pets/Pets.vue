<template>
  <div>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <TitleBar title="Tus mascotas"></TitleBar>

    <Loader v-if="loading"></Loader>

    <div v-else>
      <div v-if="pets !== null && pets.length > 0">
        <CircleButtonLinkList :button-link-data="buttonLinkData"></CircleButtonLinkList>

        <PetMenu
            :active="activePet.id"
            :pets="pets" @show-pet="showPet"
        ></PetMenu>

        <PetDetail :pet="activePet" @deleted="refreshPets()"></PetDetail>
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
import CircleButtonLinkList from "../../components/general/buttons/floating/CircleButtonLinkList";
import NoPet from "@/components/pets/show/NoPet";
import BaseNotification from "../../components/general/notifications/BaseNotification";
import store from "../../store";

export default {
  name: "Pets",
  components: {
    CircleButtonLinkList,
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
    ],
    store
  }),
  mounted() {
    petServices.getOwnerPets()
        .then(res => {
          this.pets = res.data.pets;
          this.activePet = res.data.pets[0];
          this.loading = false;
          
          this.refreshButtonLinksData();
        });
  }
  ,
  methods: {
    showPet(pet_id) {
      this.activePet = this.pets.find(pet => pet.id === pet_id);

      this.refreshButtonLinksData();
    }
    ,

    refreshPets() {
      this.loading = true;

      petServices.getOwnerPets()
          .then(res => {
            this.pets = res.data.pets;
            this.activePet = res.data.pets[0];

            this.refreshButtonLinksData();

            this.loading = false;
          });
    },

    refreshButtonLinksData(){
      this.buttonLinkData[1].pathParams.pet_id = this.activePet.id
      this.buttonLinkData[2].pathParams.pet_id = this.activePet.id
      this.buttonLinkData[3].pathParams.pet_id = this.activePet.id
    }
  }
}
</script>

