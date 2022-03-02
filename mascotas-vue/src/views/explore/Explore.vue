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
              @filter-by-type="filterByType"
          />

          <ExploreSearchBar
              :professionals="professionals"
              :loading="loading"
              @filter-by-query="filterByQuery"
          />
        </div>

        <ExploreList
            v-if="!loading"
            :professionals="filteredProfessionals"
            :userTypes="userTypes"
            :selectedProfessionalId="selectedProfessionalId"
            @select-professional="selectProfessional"
        />
      </div>
    </div>
  </div>
</template>

<script>
import BaseNotification from "@/components/general/notification/BaseNotification";
import ExploreList from "@/components/geolocation/list/ExploreList";
import ExploreSearchBar from "@/components/geolocation/filter/ExploreSearchBar";
import ExploreFilterByType from "@/components/geolocation/filter/ExploreFilterByType";
import Map from "@/components/geolocation/Map";
import store from "@/store";
import userService from "@/services/users";

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
    professionalsFilteredByQuery: [],
    professionalsFilteredByType: [],
    userTypes: [],
    filteredUserType: null,
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

                this.filteredProfessionals = this.professionals;

                this.professionalsFilteredByType = this.professionals;

                this.professionalsFilteredByQuery = this.professionals;

                this.dropMarkers(this.filteredProfessionals);
              });
        })
  },
  methods: {
    selectProfessional(id) {
      this.selectedProfessionalId = id;
    },

    dropMarkers() {
      let map = this.$refs.hereMap;

      map.dropMarker(this.filteredProfessionals, this.filteredUserType);
    },

    filterByQuery(filteredProfessionals) {
      this.professionalsFilteredByQuery = filteredProfessionals;

      this.combineFilteredProfessionals();
    },

    filterByType(filteredProfessionals, typeId) {
      this.professionalsFilteredByType = filteredProfessionals;

      this.filteredUserType = typeId || null;

      this.combineFilteredProfessionals();
    },

    /**
     * Combines filter of usertype and search query
     */
    combineFilteredProfessionals() {
      this.filteredProfessionals = [];

      this.professionalsFilteredByQuery.forEach((prof) => {
        let pos = this.professionalsFilteredByType.map(function (obj) {
          return obj.id;
        }).indexOf(prof.id)

        if (pos !== -1) {
          this.filteredProfessionals.push(prof);
        }
      });
      this.dropMarkers();
    },

    sortProfessionals(sortedProfessionals) {
      this.filteredProfessionals = sortedProfessionals;
    }
  },
}
</script>