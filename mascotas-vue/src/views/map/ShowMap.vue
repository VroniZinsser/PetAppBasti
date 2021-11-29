<template>
  <v-container fluid>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />
    <Map ref="hereMap"/>
  </v-container>
</template>

<script>
import Map from "@/components/geolocation/Map";
import userService from "../../services/users";
import BaseNotification from "@/components/general/notifications/BaseNotification"
import store from "@/store"

export default {
  name: "ShowMap",
  components: {
    Map,
    BaseNotification
  },
  data: () => ({
    professionals: [],
    store,
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
