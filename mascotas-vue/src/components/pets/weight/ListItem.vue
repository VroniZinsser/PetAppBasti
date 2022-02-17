<template>
  <li>
    <div class="content">
      <p><span class="sr-only">Peso: </span>{{ displayWeight(weight.weight) }}</p>
      <p><span class="sr-only">Fecha: </span>{{ formatDate(weight.date) }}</p>
    </div>

    <div class="actions">
      <router-link :to="{name: 'WeightFormEdit', params: {pet_id: this.$route.params.pet_id, weight_id : weight.id}}">
        <span class="sr-only">Editar peso de {{ displayWeight(weight.weight) }} (icono </span>
        <span class="material-icons">edit</span>
        <span class="sr-only">)</span>
      </router-link>

      <form action="#" method="POST" @submit.prevent="deleteWeight">
        <button>
          <span class="sr-only">Eliminar (icono </span>
          <span class="material-icons">delete</span>
          <span class="sr-only">)</span>
        </button>
      </form>
    </div>
  </li>
</template>

<script>
import {displayWeight, formatDate} from "@/helpers";
import weightService from "@/services/weights";

export default {
  name: "ListItem",
  props: {
    weight: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      displayWeight,
      formatDate
    }
  },
  methods: {
    deleteWeight() {
      weightService.delete(this.weight.id)
          .then(() => {
            this.$emit('deleted', this.weight.id);
          })
    }
  },
  mounted() {
  }
}
</script>

<style scoped>

</style>