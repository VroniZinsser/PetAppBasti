<template>
  <div>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <div class="explore-container">
      <Map ref="hereMap"
        :selectedProfessionalId="selectedProfessionalId"
        @select-professional="selectProfessional"
      />

      <ExploreList 
        :professionals="professionals"
        :userTypes="userTypes"
        :selectedProfessionalId="selectedProfessionalId"
        @select-professional="selectProfessional">
      </ExploreList>
    </div>
  </div>
</template>

<script>
import Map from "@/components/geolocation/Map";
import ExploreList from "@/components/geolocation/list/ExploreList";
import userService from "../../services/users";
import BaseNotification from "@/components/general/notifications/BaseNotification"
import store from "@/store"

export default {
  name: "Explore",
  components: {
    Map,
    BaseNotification,
    ExploreList,
  },
  data: () => ({
    professionals: [],
    userTypes: [],
    store,
    selectedProfessionalId: null,
  }),
  mounted() {
    let map = this.$refs.hereMap;
    userService.getProfessionals()
        .then(res => {
          this.professionals = res.data.users;
          map.dropMarker(this.professionals);
        });

    userService.getProfessionalUserTypes()
        .then(res => {
          this.userTypes = res.data.user_types;
        })
  },
  methods: {
    selectProfessional(id) {
      this.selectedProfessionalId = id;
    }
  }
}
</script>

<style scoped>

</style>
