<template>
  <v-container fluid>
    <PetMenu :active="$route.params.petsId"></PetMenu>

    <PetDetail :pets_id="$route.params.petsId"></PetDetail>
  </v-container>
</template>

<script>
import PetMenu from "../../components/pets/show/PetMenu";
import PetDetail from "../../components/pets/show/PetDetail";
// import petServices from "../../services/pets";

export default {
  name: "Pet",
  components: {
      PetMenu,
      PetDetail
    },
}
</script>