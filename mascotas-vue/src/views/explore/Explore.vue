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
    <div>
      <div>
        <v-select
            :items="userTypes"
            item-text="name"
            item-value="id"
            label="Tipo de profesional"
            outlined
            v-model="professionalTypeId"
        ></v-select>
      </div>
      <ExploreList 
        :professionals="filteredProfessionals"
        :userTypes="userTypes"
        :selectedProfessionalId="selectedProfessionalId"
        @select-professional="selectProfessional">
      </ExploreList>
    </div>
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
    filteredProfessionals: [],
    userTypes: [],
    store,
    selectedProfessionalId: null,
    professionalTypeId: null,
  }),
  mounted() {
    userService.getProfessionals()
        .then(res => {
          this.professionals = res.data.users;
          this.filteredProfessionals = res.data.users;
          this.dropMarkers();
        });

    userService.getProfessionalUserTypes()
        .then(res => {
          this.userTypes = res.data.user_types;
        })
  },
  methods: {
    selectProfessional(id) {
      this.selectedProfessionalId = id;
    },

    dropMarkers() {
      let map = this.$refs.hereMap;
      map.dropMarker(this.filteredProfessionals);
    }
  },
  watch: {
    professionalTypeId(id) {
      this.filteredProfessionals = [];
      this.professionals.forEach((professional) => {
        professional.user_types.forEach((type) => {
          if(type.id === id) {
            this.filteredProfessionals.push(professional);
          }
        })
      })
      this.dropMarkers();
    },
  },
}
</script>

<style scoped>

</style>
