<template>
  <TheLoader v-if="loading"/>

  <v-container v-else class="medical-list-container">
    <PetDetailMedicalListHeader title="Pesos de la mascota"/>

    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <BaseButtonCircleLinkList v-if="isOwner" :button-link-data="buttonLinkData"/>

    <template v-if="weights.length > 0">
      <div class="actual-weight">
        <span>Peso actual: </span>

        <span class="current-weight">{{ displayWeight(weights[0].weight) }}</span>

        <span class="weight-date"> ({{ formatDate(weights[0].date) }})</span>
      </div>

      <WeightList 
        :weights="weights"
        @delete="prepareDeleteWeight"/>

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
import BaseButtonCircleLinkList from "@/components/general/button/floating/BaseButtonCircleLinkList";
import BaseDialogWarn from "@/components/general/notification/BaseDialogWarn";
import BaseNotification from "@/components/general/notification/BaseNotification";
import PetDetailMedicalListHeader from "@/components/pet/show/detail/medical/PetDetailMedicalListHeader";
import petServices from "@/services/pets";
import store from "@/store";
import TheLoader from "@/components/general/layout/TheLoader";
import WeightList from "@/components/pet/weight/WeightList";
import weightService from "@/services/weights";
import {handleAccessError, handleAuthenticationError, displayWeight, formatDate} from "@/helpers";

export default {
  name: "PetWeightList",
  components: {
    PetDetailMedicalListHeader,
    BaseDialogWarn,
    BaseNotification,
    BaseButtonCircleLinkList,
    TheLoader,
    WeightList
  },
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
      handleAuthenticationError,
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

  computed: {
    isOwner() {
      return !this.store.user.is_professional;
    }
  },
  mounted() {
    if (this.$route.params.pet_id) {
      petServices.getWeights(this.$route.params.pet_id)
          .then(res => {
            this.loading = false

            if (this.handleAuthenticationError(res)) return;

            this.weights = res.data.weights;
          })
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
            this.loading = false

            if (this.handleAccessError(res)) return;

            this.weights = this.weights.filter(weight => weight.id !== this.wToDelete);

            this.$emit('create-notification', 'success', 'El peso se eliminó con éxito');

            this.wToDelete = null;

            this.showWarnDialog = false;
          })
    }
  },
}
</script>