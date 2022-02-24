<template>
  <Loader v-if="loading"></Loader>

  <v-container v-else class="medical-list-container">
    <ListHeader title="Vacunas de la mascota"/>

    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <CircleButtonLinkList :button-link-data="buttonLinkData"></CircleButtonLinkList>

    <template v-if="vaccines.length > 0">

      <VaccineList :vaccines="vaccines" @delete="prepareDeleteVaccine"></VaccineList>

      <WarnDialog
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
import Loader from "@/components/general/notifications/Loader";
import BaseNotification from "@/components/general/notifications/BaseNotification";
import WarnDialog from "@/components/general/notifications/WarnDialog";
import store from "@/store";
import {formatDate} from "@/helpers";
import vaccineService from "@/services/vaccines";
import VaccineList from "@/components/pets/vaccine/List";
import petServices from "@/services/pets";
import CircleButtonLinkList from "@/components/general/buttons/floating/CircleButtonLinkList";
import ListHeader from "@/components/pets/show/medical/ListHeader";

export default {
  name: "List",
  components: {ListHeader, CircleButtonLinkList, WarnDialog, BaseNotification, Loader, VaccineList},
  props: {},
  data() {
    return {
      vaccines: null,
      loading: true,
      store,
      formatDate,
      vToDelete: null,
      showWarnDialog: false,
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
          .then(() => {
            this.vaccines = this.vaccines.filter(vaccine => vaccine.id !== this.vToDelete);

            this.$emit('create-notification', 'success', 'La vacuna se eliminó con éxito');

            this.vToDelete = null;

            this.showWarnDialog = false;

            this.loading = false
          })
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
  }
}
</script>