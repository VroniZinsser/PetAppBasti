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
        @sort-professionals="sortProfessionals"
      />
      <div class="side-bar">
        <div class="explore-filters">
          <ExploreFilterByType 
            :professionals="professionals"
            :userTypes="userTypes"
            :loading="loading"
            @update-filtered-professionals="updateFilteredProfessionals"
          />
          <ExploreSearchBar 
            :professionals="professionals"
            :loading="loading"
            @update-filtered-professionals="updateFilteredProfessionals"
          />
        </div>
        <ExploreList 
          v-if="!loading"
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
import BaseNotification from "@/components/general/notifications/BaseNotification";
import store from "@/store";

export default {
  name: "Explore",
  components: {
    Map,
    BaseNotification,
    ExploreList,
    ExploreSearchBar,
    ExploreFilterByType,
  },
  data: () => ({
    professionals: [],
    filteredProfessionals: [],
    userTypes: [],
    store,
    selectedProfessionalId: null,
    loading: true,
  }),
  mounted() {
    userService.getProfessionalUserTypes()
      .then(res => {
        this.userTypes = res.data.user_types;
        this.userTypes.unshift({
          'id': -1,
          'name': 'Todos los profesionales'
        })

        userService.getProfessionals()
        .then(res => {
           this.loading = false;
          this.professionals = res.data.users;
          this.filteredProfessionals = res.data.users;
         
          this.dropMarkers(this.filteredProfessionals);
        });
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

    sortProfessionals(sortedProfessionals) {
      this.filteredProfessionals = sortedProfessionals;
    }
  },
}
</script>