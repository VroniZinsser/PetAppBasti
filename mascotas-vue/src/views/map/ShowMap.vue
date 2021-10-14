<template>
  <v-container fluid>
    <Map 
      :center="center"
      ref="hereMap"
    />

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
    center:{ 
      lat: -34.60487, 
      lng: -58.42098 
    }
    
  }),

  mounted() {
    let map = this.$refs.hereMap;
    map.dropMarker();

  }
  
}
</script>

<style scoped>

</style>