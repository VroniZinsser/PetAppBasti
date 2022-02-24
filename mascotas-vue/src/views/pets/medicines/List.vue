<template>
  <Loader v-if="loading"></Loader>

  <v-container v-else class="medical-list-container">
    <ListHeader title="Medicamentos de la mascota" />
  </v-container>
</template>

<script>
import Loader from "@/components/general/notifications/Loader";
import ListHeader from "@/components/pets/show/medical/ListHeader";

export default {
  name: "List",
  components: {ListHeader, Loader},
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