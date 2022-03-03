<template>
  <div class="pet-medical-info">
    <Weight
        :weights="sortedWeights"
        :placeholder="placeholder.weight"
        :pet_name="pet.name"
        :pet_id="pet.id"
    />

    <Medicine
        :medicines="sortedMedicinesArray"
        :placeholder="placeholder.medicine"
        :pet_name="pet.name"
        :pet_id="pet.id"
        @delete="prepareDeleteMedicine"
    />

    <Observation
        :observation="pet.observation"
        :placeholder="placeholder.observation"
        :pet_name="pet.name"
        :pet_id="pet.id"
    />

    <Vaccine
        :vaccines="sortedVaccines"
        :placeholder="placeholder.vaccine"
        :pet_name="pet.name"
        :pet_id="pet.id"
    />

    <WarnDialog
        :showDialog="showWarnDialog"
        dialogTitle="¿Querés eliminar este medicamento?"
        acceptButtonText="Borrar medicamento"
        @cancel="cancelDelete"
        @accept="deleteMedicine"
    />
  </div>
</template>

<script>
import Medicine from "@/components/pet/show/detail/medical/PetDetailMedicalMedicine";
import medicineService from "@/services/medicines";
import Observation from "@/components/pet/show/detail/medical/PetDetailMedicalObservation";
import Vaccine from "@/components/pet/show/detail/medical/PetDetailMedicalVaccine";
import WarnDialog from "@/components/general/notification/BaseDialogWarn";
import Weight from "@/components/pet/show/detail/medical/PetDetailMedicalWeight";
import store from "@/store";
import {createStaticImgPath} from "@/helpers";

export default {
  name: "PetDetailMedical",
  props: {
    pet: {
      type: Object,
      required: true,
    }
  },
  components: {
    WarnDialog,
    Weight,
    Medicine,
    Observation,
    Vaccine
  },
  data: function () {
    return {
      loading: true,
      medicines: [],
      vaccines: [],
      weights: [],
      placeholder: {
        vaccine: {
          img_src: createStaticImgPath('ui/no_vaccine.png'),
          text: `Agregá las vacunas que :petName ya ha obtenido.`,
          cta: {
            path_name: 'VaccineForm',
            text: 'Agregar vacuna'
          }
        },
        weight: {
          img_src: createStaticImgPath('ui/no_weight.png'),
          text: `¿Cuánto pesa :petName? Anotalo regularmente para llevar un mejor control sobre su salud.`,
          cta: {
            path_name: 'WeightForm',
            text: 'Agregar peso'
          }
        },
        medicine: {
          img_src: createStaticImgPath('ui/no_medicine.png'),
          text: `Agregá medicamentos actuales o del pasado para el registro de medicación de :petName.`,
          cta: {
            path_name: 'MedicineForm',
            text: 'Agregar medicamento'
          }
        },
        observation: {
          img_src: createStaticImgPath('ui/no_observation.png'),
          text: `Aquí tenés espacio para anotar observaciones, dudas o comentarios.`,
          cta: {
            path_name: 'ObservationForm',
            text: 'Agregar nota'
          }
        }
      },
      mToDelete: null,
      showWarnDialog: false,
      store,
    }
  },
  computed: {
    sortedMedicinesArray() {
      let medicines = this.medicines;

      return medicines.sort((a, b) => (a.end_date < b.end_date) ? 1 : -1);
    },

    sortedVaccines() {
      if (this.vaccines.length > 0) {
        let array = this.vaccines;

        return array.sort((a, b) => (a.date < b.date) ? 1 : -1);
      }

      return [];
    },

    sortedWeights() {
      if (this.weights.length > 0) {
        let array = this.weights;

        return array.sort((a, b) => (a.date < b.date) ? 1 : -1);
      }

      return [];
    }
  },

  watch: {
    pet() {
      this.updateMedicalData();
    }
  },

  mounted() {
    this.updateMedicalData();
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
            this.$parent.$emit('delete-medicine', this.mToDelete);

            this.store.setStatus({
              msg: 'El medicamento se eliminó con éxito',
              type: 'success',
            });

            this.mToDelete = null;

            this.showWarnDialog = false;

            this.loading = false
          })
    },

     updateMedicalData() {
      this.medicines = this.pet.medicines;

      this.vaccines = this.pet.vaccines;

      this.weights = this.pet.weights;
    }
  },
}
</script>
