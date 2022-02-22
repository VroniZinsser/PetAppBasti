<template>
  <li>
    <div class="content">
      <p><span class="sr-only">Nombre: </span>{{ vaccine.name }}</p>
      <p><span class="sr-only">Fecha: </span>{{ formatDate(vaccine.date) }}</p>
    </div>

    <div class="actions">
      <router-link
          :to="{name: 'VaccineFormEdit', params: {pet_id: this.$route.params.pet_id, vaccine_id : vaccine.id}}">
        <span class="sr-only">Editar vacuna {{ vaccine.name }} (icono </span>
        <span class="material-icons">edit</span>
        <span class="sr-only">)</span>
      </router-link>

      <form action="#" method="POST" @submit.prevent="$emit('delete', vaccine.id);">
        <button>
          <span class="sr-only">Eliminar {{ vaccine.name }} (icono </span>
          <span class="material-icons">delete</span>
          <span class="sr-only">)</span>
        </button>
      </form>
    </div>
  </li>
</template>

<script>
import {formatDate} from "@/helpers";

export default {
  name: "ListItem",
  components: {},
  props: {
    vaccine: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      formatDate
    }
  },
  methods: {},
  mounted() {
  }
}
</script>