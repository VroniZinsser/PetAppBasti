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
      <ExploreFilterByType 
        :professionals="professionals"
        :userTypes="userTypes"
        @update-filtered-professionals="updateFilteredProfessionals"
      />
      <ExploreSearchBar 
        :professionals="professionals"
        @update-filtered-professionals="updateFilteredProfessionals"
      />
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
import ExploreSearchBar from "@/components/geolocation/filter/ExploreSearchBar";
import ExploreFilterByType from "@/components/geolocation/filter/ExploreFilterByType";
import userService from "../../services/users";
import BaseNotification from "@/components/general/notifications/BaseNotification"
import store from "@/store"

export default {
  name: "Explore",
  components: {
    Map,
    BaseNotification,
    ExploreList,
    ExploreSearchBar,
    ExploreFilterByType
  },
  data: () => ({
    professionals: [],
    filteredProfessionals: [],
    userTypes: [],
    store,
    selectedProfessionalId: null,
    professionalTypeId: null,
    searchString: null,
  }),
  mounted() {
    userService.getProfessionals()
        .then(res => {
          this.professionals = res.data.users;
          this.filteredProfessionals = res.data.users;
          this.dropMarkers(this.filteredProfessionals);
        });

    userService.getProfessionalUserTypes()
        .then(res => {
          this.userTypes = res.data.user_types;
          this.userTypes.unshift({
            'id': -1,
            'name': 'Todos los profesionales'
          })
        })
  },
  methods: {
    selectProfessional(id) {
      this.selectedProfessionalId = id;
    },

    dropMarkers(professionals) {
      let map = this.$refs.hereMap;
      map.dropMarker(professionals);
    },

    updateFilteredProfessionals(updatedProfessionals) {
      this.filteredProfessionals = updatedProfessionals;
      this.dropMarkers(this.filteredProfessionals);
    },
  },
}
</script>