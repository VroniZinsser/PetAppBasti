<template>
  <li>
    <div class="content">
      <p><span class="sr-only">Peso: </span>{{ displayWeight(weight.weight) }}</p>

      <p><span class="sr-only">Fecha: </span>{{ formatDate(weight.date) }}</p>
    </div>

    <div v-if="ownerView" class="actions">
      <router-link :to="{name: 'WeightFormEdit', params: {pet_id: this.$route.params.pet_id, weight_id : weight.id}}">
        <span class="sr-only">Editar peso de {{ displayWeight(weight.weight) }} (icono </span>

        <span class="material-icons">edit</span>

        <span class="sr-only">)</span>
      </router-link>

      <form action="#" method="POST" @submit.prevent="$emit('delete', weight.id);">
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

export default {
  name: "WeightListItem",
  props: {
    weight: {
      type: Object,
      required: true,
    },
    ownerView: {
      type: Boolean,
      default: false,
    }
  },
  data() {
    return {
      displayWeight,
      formatDate
    }
  },
}
</script>