<template>
  <TheLoader v-if="loading"/>

  <v-container v-else class="medical-list-container">
    <PetDetailMedicalListHeader title="Medicamentos de la mascota"/>

    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <BaseButtonCircleLinkList :button-link-data="buttonLinkData"/>

    <template v-if="medicines.length > 0">
      <MedicineList :medicines="medicines" @delete="prepareDeleteMedicine"/>

      <BaseDialogWarn
          :showDialog="showWarnDialog"
          dialogTitle="¿Querés eliminar este medicamento?"
          acceptButtonText="Borrar medicamento"
          @cancel="cancelDelete"
          @accept="deleteMedicine"
      />
    </template>

    <p v-else>Esta mascota no tiene ningún medicamento agregado.</p>
  </v-container>
</template>

<script>
import BaseButtonCircleLinkList from "@/components/general/button/floating/BaseButtonCircleLinkList";
import BaseDialogWarn from "@/components/general/notification/BaseDialogWarn";
import BaseNotification from "@/components/general/notification/BaseNotification";
import MedicineList from "@/components/pet/medicine/MedicineList";
import medicineService from "@/services/medicines";
import PetDetailMedicalListHeader from "@/components/pet/show/detail/medical/PetDetailMedicalListHeader";
import petServices from "@/services/pets";
import store from "@/store";
import TheLoader from "@/components/general/layout/TheLoader";

export default {
  name: "MedicineList",
  components: {
    BaseButtonCircleLinkList,
    BaseDialogWarn,
    BaseNotification,
    PetDetailMedicalListHeader,
    TheLoader,
    MedicineList
  },
  data() {
    return {
      medicines: null,
      loading: true,
      store,
      mToDelete: null,
      showWarnDialog: false,
      buttonLinkData: [
        {
          icon: 'medication',
          text: 'Nuevo medicamento',
          pathName: 'MedicineForm',
          pathParams: {pet_id: this.$route.params.pet_id},
          default: true,
        },
      ],
    }
  },
  mounted() {
    if (this.$route.params.pet_id) {
      petServices.getMedicines(this.$route.params.pet_id)
          .then(res => {
            this.medicines = res.data.medicines;

            this.loading = false
          })
    }
  },
  methods: {
    prepareDeleteMedicine(medicine_id) {
      this.mToDelete = medicine_id;

      this.showWarnDialog = true;
    },

    cancelDelete() {
      this.mToDelete = null;

      this.showWarnDialog = false;
    },

    deleteMedicine() {
      this.loading = true;

      medicineService.delete(this.mToDelete)
          .then(() => {
            this.medicines = this.medicines.filter(medicine => medicine.id !== this.mToDelete);

            this.$emit('create-notification', 'success', 'El medicamento se eliminó con éxito');

            this.mToDelete = null;

            this.showWarnDialog = false;

            this.loading = false
          })
    }
  },
}
</script>