<template>
  <TheLoader v-if="loading"/>

  <v-container v-else class="medical-list-container">
    <PetDetailMedicalListHeader title="Vacunas de la mascota"/>

    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <BaseButtonCircleLinkList :button-link-data="buttonLinkData"/>

    <template v-if="vaccines.length > 0">

      <VaccineList :vaccines="vaccines" @delete="prepareDeleteVaccine"/>

      <BaseDialogWarn
          :showDialog="showWarnDialog"
          dialogTitle="¿Querés eliminar esta vacuna?"
          acceptButtonText="Borrar vacuna"
          @cancel="cancelDelete"
          @accept="deleteVaccine"
      />
    </template>

    <p v-else>Esta mascota no tiene ninguna vacuna agregada.</p>
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
import VaccineList from "@/components/pet/vaccine/VaccineList";
import vaccineService from "@/services/vaccines";
import {formatDate, handleAccessError} from "@/helpers";

export default {
  name: "VaccineList",
  components: {
    PetDetailMedicalListHeader,
    BaseButtonCircleLinkList,
    BaseDialogWarn,
    BaseNotification,
    TheLoader,
    VaccineList
  },
  data() {
    return {
      vaccines: null,
      loading: true,
      store,
      formatDate,
      vToDelete: null,
      showWarnDialog: false,
      handleAccessError,
      buttonLinkData: [
        {
          icon: 'vaccines',
          text: 'Nueva vacuna',
          pathName: 'VaccineForm',
          pathParams: {pet_id: this.$route.params.pet_id},
          default: true,
        },
      ],
    }
  },
  mounted() {
    if (this.$route.params.pet_id) {
      petServices.getVaccines(this.$route.params.pet_id)
          .then(res => {
            this.vaccines = res.data.vaccines;

            this.loading = false
          })
    }
  },
  methods: {
    prepareDeleteVaccine(vaccine_id) {
      this.vToDelete = vaccine_id;

      this.showWarnDialog = true;
    },

    cancelDelete() {
      this.vToDelete = null;

      this.showWarnDialog = false;
    },

    deleteVaccine() {
      this.loading = true;

      vaccineService.delete(this.vToDelete)
          .then((res) => {
            if (this.handleAccessError(res)) return;

            this.vaccines = this.vaccines.filter(vaccine => vaccine.id !== this.vToDelete);

            this.$emit('create-notification', 'success', 'La vacuna se eliminó con éxito');

            this.vToDelete = null;

            this.showWarnDialog = false;

            this.loading = false
          })
    }
  },
}
</script>