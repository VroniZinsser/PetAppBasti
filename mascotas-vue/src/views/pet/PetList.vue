<template>
  <div>
    <TitleBar title="Tus mascotas"/>

    <TheLoader v-if="loading"/>

    <div v-else>
      <div v-if="pets !== null && pets.length > 0">
        <BaseButtonCircleLinkList :button-link-data="buttonLinkData"/>

        <PetMenuList
            :active="activePet.id"
            :pets="pets" @show-pet="updateActivePet"
        />

        <BaseNotification
            v-if="store.status.msg != null"
            :type="store.status.type"
            :text="store.status.msg"
            :title="store.status.title"
        />

        <PetDetail :pet="activePet" @deleted="refreshPets()"/>
      </div>

      <div v-else>
        <BaseButtonCircleLinkList :button-link-data="[buttonLinkData[0]]"/>

        <BaseNotification
            v-if="store.status.msg != null"
            :type="store.status.type"
            :text="store.status.msg"
            :title="store.status.title"
        />

        <PetEmpty/>
      </div>
    </div>
  </div>
</template>

<script>
import BaseButtonCircleLinkList from "@/components/general/button/floating/BaseButtonCircleLinkList";
import BaseNotification from "@/components/general/notification/BaseNotification";
import PetEmpty from "@/components/pet/show/PetEmpty";
import PetDetail from "@/components/pet/show/detail/PetDetail";
import PetMenuList from "@/components/pet/show/PetMenuList";
import petServices from "@/services/pets";
import store from "@/store";
import TheLoader from "@/components/general/layout/TheLoader";
import TitleBar from "@/components/general/layout/TitleBar";

export default {
  name: "PetList",
  components: {
    BaseButtonCircleLinkList,
    BaseNotification,
    TitleBar,
    PetMenuList,
    PetDetail,
    TheLoader,
    PetEmpty,
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
        pathName: 'MedicineForm',
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
    this.refreshPets();
  },
  methods: {
    /**
     * set active pet to the given id, refresh buttons and update active pet in the store
     */
    updateActivePet(pet_id) {
      this.activePet = this.pets.find(pet => pet.id === pet_id);

      this.refreshButtonLinksData();

      this.store.setActivePet(pet_id);
    },

    /**
     * Retrieve owners' pets from the server and update active pet
     * with the petId saved in the store or otherwise with the first pet from the server response
     */
    refreshPets() {
      this.loading = true;

      petServices.getOwnerPets()
          .then(res => {
            this.pets = res.data.pets;

            if (this.pets !== null && this.pets.length > 0) {
              let activePetId = this.store.activePet.id ? this.store.activePet.id : res.data.pets[0].id;

              this.updateActivePet(activePetId);
            }

            this.loading = false;
          });
    },

    refreshButtonLinksData() {
      if (this.pets !== null && this.pets.length > 0) {
        this.buttonLinkData[1].pathParams.pet_id = this.activePet.id

        this.buttonLinkData[2].pathParams.pet_id = this.activePet.id

        this.buttonLinkData[3].pathParams.pet_id = this.activePet.id
      }
    }
  }
}
</script>

