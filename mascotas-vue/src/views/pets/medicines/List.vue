<template>
  <Loader v-if="loading"></Loader>

  <v-container v-else class="medical-list-container">
    <header>
      <router-link :to="{name: 'Pets'}">
        <span class="sr-only">Volver al listado de mascotas</span>
        <span class="material-icons">arrow_back</span>
      </router-link>

      <h1>Medicamentos de la mascota</h1>
    </header>
  </v-container>
</template>

<script>
import Loader from "@/components/general/notifications/Loader";

export default {
  name: "List",
  components: {Loader},
  props: {},
  data() {
    return {
      loading: true,
    }
  },
  methods: {},
  mounted() {
    this.loading = false;
  }
}
</script>