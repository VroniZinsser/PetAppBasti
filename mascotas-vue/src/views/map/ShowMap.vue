<template>
  <v-container fluid>
    <h1>Mapa</h1>
    <h2>Tus coordinatas: </h2>
    <p>Latitude: {{ coordinates.lat }}, Longitude: {{ coordinates.lng }}</p>

    <h2>Here Maps</h2>
    <Map 
      ref="hereMap"
    />

    <h2>Vue2-google-maps</h2>
    <GmapMap
      :center="coordinates"
      :zoom="14"
      style="width: 640px; height:360px; margin:32px auto;"></GmapMap>

  </v-container>

</template>

<script>

import Map from "@/components/users/map/Map";

export default {
  name: "ShowMap",
  components: {
    Map,
    
  },
  data: () => ({
    coordinates: {
      lat: 0,
      lng:0
    }
    
  }),

  created() {
    this.$getLocation({})
      .then(coordinates => {
        this.coordinates = coordinates;
      })
      .catch(error => alert(error));
  },

  mounted() {
    
    let map = this.$refs.hereMap;
    map.dropMarker();

  }
  
}
</script>

<style scoped>

</style>