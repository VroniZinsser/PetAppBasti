
<template>
  <div id="map">
    <div id="mapContainer" style="height:600px;width:100%" ref="hereMap"></div>
  </div>
</template>

<script>
export default {
  name: "Map",
  data() {
    return {
      platform: null,
      apikey: "I8Jxzv6xtyMgJodcYgvnsbWiuhjAN6zZhEv0_IQ4Ej8",
      map: {},
      geocodingService: {},
      currentLocation: {
        lat: 10,
        lng: 10
      }
    };
  },
  
  async mounted() {
    const platform = new window.H.service.Platform({
      apikey: this.apikey
    });
    this.platform = platform;
    this.initializeHereMap();
    this.geocodingService = platform.getGeocodingService();
    this.getCurrentLocation();
  },
  methods: {
    getCurrentLocation() {
      if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(position => {
          this.currentLocation.lat = position.coords.latitude;
          this.currentLocation.lng = position.coords.longitude;
          this.map.setCenter(this.currentLocation);
        });
      }
    },
    initializeHereMap() {
      const mapContainer = this.$refs.hereMap;
      const H = window.H;
      var maptypes = this.platform.createDefaultLayers();

      this.map = new H.Map(mapContainer, maptypes.vector.normal.map, {
        zoom: 14,
        center: this.currentLocation
      });
      
      addEventListener("resize", () => this.map.getViewPort().resize());
      new H.mapevents.Behavior(new H.mapevents.MapEvents(this.map));
      H.ui.UI.createDefault(this.map, maptypes);
    },

    dropMarker(professionals) {
      const H = window.H;
      for(let i = 0; i < professionals.length; i++) {
        let marker = new H.map.Marker({ 
          lat: professionals[i].latitude, 
          lng: professionals[i].longitude
        });
        this.map.addObject(marker);
      }
    }
  }
};
</script>

<style scoped>
#map {
  width: 60vw;
  min-width: 360px;
  text-align: center;
  margin: 5% auto;
  background-color: #ccc;
}
</style>