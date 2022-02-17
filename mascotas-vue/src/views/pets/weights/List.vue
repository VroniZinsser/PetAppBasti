<template>
  <Loader v-if="loading"></Loader>

  <v-container v-else class="weight-list-container">
    <header>
      <router-link :to="{name: 'Pets'}">
        <span class="sr-only">Volver al listado de mascotas</span>
        <span class="material-icons">arrow_back</span>
      </router-link>

      <h1>Pesos de la mascota</h1>
    </header>

    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <CircleButtonLinkList :button-link-data="buttonLinkData"></CircleButtonLinkList>

    <template v-if="weights.length > 0">
      <div class="actual-weight">
        <span>Peso actual: </span>
        <span class="current-weight">{{ displayWeight(weights[0].weight) }}</span>
        <span class="weight-date"> ({{ formatDate(weights[0].date) }})</span>
      </div>

      <WeightList :weights="weights" @deleted="updateWeightList"></WeightList>
    </template>

    <p v-else>Esta mascota no tiene ningún peso agregado todavía.</p>
  </v-container>
</template>

<script>
import petServices from "@/services/pets";
import WeightList from "@/components/pets/weight/List";
import Loader from "@/components/general/notifications/Loader";
import CircleButtonLinkList from "@/components/general/buttons/floating/CircleButtonLinkList";
import BaseNotification from "@/components/general/notifications/BaseNotification";
import store from "@/store";
import {displayWeight, formatDate} from "@/helpers";

export default {
  name: "List",
  components: {BaseNotification, CircleButtonLinkList, Loader, WeightList},
  data() {
    return {
      weights: null,
      loading: true,
      store,
      displayWeight,
      formatDate,
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
  methods: {
    updateWeightList(weight_id) {
      this.loading = true;
      // console.warn("Se elimino un elemento", weight_id)
      //
      // console.log(this.weights.find(e => e.id === weight_id));
      this.weights = this.weights.filter(weight => weight.id !== weight_id);

      this.$emit('create-notification', 'success', 'El peso se eliminó con éxito');

      this.loading = false
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