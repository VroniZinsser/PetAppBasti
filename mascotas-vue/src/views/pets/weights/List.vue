<template>
  <Loader v-if="loading"></Loader>

  <div v-else>
    <div>
      <router-link :to="{name: 'Pets'}">
        <span class="sr-only">Volver al listado de mascotas</span>
        <span class="material-icons">arrow_back</span>
      </router-link>

      <h1>Pesos de la mascota</h1>
    </div>

    <CircleButtonLinkList :button-link-data="buttonLinkData"></CircleButtonLinkList>

    <WeightList :weights="weights"></WeightList>
  </div>
</template>

<script>
import petServices from "@/services/pets";
import WeightList from "@/components/pets/weight/List";
import Loader from "@/components/general/notifications/Loader";
import CircleButtonLinkList from "@/components/general/buttons/floating/CircleButtonLinkList";

export default {
  name: "List",
  components: {CircleButtonLinkList, Loader, WeightList},
  data() {
    return {
      weights: null,
      loading: true,
      buttonLinkData: [
        {
          icon: 'fitness_center',
          text: 'Nuevo peso',
          pathName: 'WeightForm',
          pathParams: {pet_id: this.$route.params.pet_id},
          default: true,
        },
      ],
    }
  },
  mounted() {
    if (this.$route.params.pet_id) {
      petServices.getWeights(this.$route.params.pet_id)
          .then(res => {
            this.weights = res.data.weights;
            this.loading = false
          })
    }
  }
}
</script>