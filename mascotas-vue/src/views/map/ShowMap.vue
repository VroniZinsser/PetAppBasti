<template>
  <v-container fluid>
    <Map ref="hereMap"/>
  </v-container>
</template>

<script>
import Map from "@/components/geolocation/Map";
import userService from "../../services/users";

export default {
  name: "ShowMap",
  components: {Map},
  data: () => ({
    professionals: []
  }),
  mounted() {
    let map = this.$refs.hereMap;
    userService.getProfessionals()
        .then(res => {
          this.professionals = res.data.users;
          map.dropMarker(this.professionals);
        });
  },
}
</script>

<style scoped>

</style>
