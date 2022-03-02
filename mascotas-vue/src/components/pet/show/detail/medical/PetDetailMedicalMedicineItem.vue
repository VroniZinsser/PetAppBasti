<template>
  <div :class="cardClass">
    <div class="medicine-item-info horizontal-bottom-line">
      <div>
        <span class="card-title">{{ medicine.name }}</span>
        <span class="card-subtitle">{{ medicine.quantity }}</span>
        <span class="card-date">{{ formatDate(medicine.start_date) }} - {{ formatDate(medicine.end_date) }}</span>
      </div>

      <div class="drop-drown-container">
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
                v-bind="attrs"
                v-on="on"
            >
              <span class="material-icons">more_vert</span>
              <span class="sr-only">Opciones</span>
            </v-btn>
          </template>

          <v-list>
            <v-list-item>
              <v-list-item-title>
                <router-link
                    :to="{name: 'MedicineFormEdit', params: {pet_id: medicine.pets_id, medicine_id: medicine.id}}">
                  <button>Editar</button>
                </router-link>
              </v-list-item-title>
            </v-list-item>

            <v-list-item>
              <v-list-item-title>
                <button @click="$emit('delete', medicine.id);">Eliminar</button>
              </v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </div>
    </div>
    <div class="medicine-item-hours">
      <div v-for="hour in formatHours" :key="hour.id">
        {{ hour.time }}
      </div>
    </div>
  </div>

</template>
<script>
import {formatDate} from "@/helpers";

export default {
  name: "MedicineItem",
  components: {},
  props: {
    medicine: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      formatDate: formatDate,
    }
  },
  computed: {
    cardClass() {
      const medicineEndDate = new Date(this.medicine.end_date);
      const actualDate = new Date(Date.now());
      return (actualDate > medicineEndDate ? 'disabled ' : '') + "card medicine-item";
    },

    formatHours() {
      this.medicine.hours.map((item) => {
        item.time = item.time.slice(0, 5);
      })

      return this.medicine.hours
    }
  }
}
</script>
