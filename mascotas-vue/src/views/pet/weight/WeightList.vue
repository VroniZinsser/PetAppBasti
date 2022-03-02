<template>
  <TheLoader v-if="loading"></TheLoader>

  <v-container v-else class="medical-list-container">
    <PetDetailMedicalListHeader title="Pesos de la mascota"/>

    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <BaseButtonCircleLinkList :button-link-data="buttonLinkData"></BaseButtonCircleLinkList>

    <template v-if="weights.length > 0">
      <div class="actual-weight">
        <span>Peso actual: </span>
        <span class="current-weight">{{ displayWeight(weights[0].weight) }}</span>
        <span class="weight-date"> ({{ formatDate(weights[0].date) }})</span>
      </div>

      <WeightList :weights="weights" @delete="prepareDeleteWeight"></WeightList>

      <BaseDialogWarn
          :showDialog="showWarnDialog"
          dialogTitle="¿Querés eliminar este peso?"
          acceptButtonText="Borrar peso"

          @cancel="cancelDelete"
          @accept="deleteWeight"
      />
    </template>

    <p v-else>Esta mascota no tiene ningún peso agregado.</p>
  </v-container>
</template>

<script>
import petServices from "@/services/pets";
import WeightList from "@/components/pet/weight/WeightList";
import TheLoader from "@/components/general/layout/TheLoader";
import BaseButtonCircleLinkList from "@/components/general/button/floating/BaseButtonCircleLinkList";
import BaseNotification from "@/components/general/notification/BaseNotification";
import store from "@/store";
import {displayWeight, formatDate} from "@/helpers";
import BaseDialogWarn from "@/components/general/notification/BaseDialogWarn";
import weightService from "@/services/weights";
import { handleAccessError } from "@/helpers";
import PetDetailMedicalListHeader from "@/components/pet/show/detail/medical/PetDetailMedicalListHeader";

export default {
  name: "WeightList",
  components: {PetDetailMedicalListHeader, BaseDialogWarn, BaseNotification, BaseButtonCircleLinkList, TheLoader, WeightList},
  data() {
    return {
      weights: null,
      loading: true,
      store,
      displayWeight,
      formatDate,
      wToDelete: null,
      showWarnDialog: false,
      handleAccessError,
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
    prepareDeleteWeight(weight_id) {
      this.wToDelete = weight_id;
      this.showWarnDialog = true;
    },

    cancelDelete() {
      this.wToDelete = null;
      this.showWarnDialog = false;
    },

    deleteWeight() {
      this.loading = true;

      weightService.delete(this.wToDelete)
          .then((res) => {
            if (this.handleAccessError(res)) return;

            this.weights = this.weights.filter(weight => weight.id !== this.wToDelete);

            this.$emit('create-notification', 'success', 'El peso se eliminó con éxito');

            this.wToDelete = null;

            this.showWarnDialog = false;

            this.loading = false
          })
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