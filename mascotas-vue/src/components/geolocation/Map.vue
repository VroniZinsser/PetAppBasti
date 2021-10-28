
<template>
  <div id="map">
    <div id="mapContainer" style="height:600px;width:100%" ref="hereMap"></div>
  </div>
</template>

<script>
import {HEREMAPS_API_KEY} from "@/constants/"

export default {
  name: "Map",
  data() {
    return {
      platform: null,
      map: {},
      geocodingService: {},
      zoom: 12,
      currentLocation: {
        lat: -34.606469,
        lng: -58.4258116
      },
    };
  },
  
  async mounted() {
    const platform = new window.H.service.Platform({
      apikey: HEREMAPS_API_KEY
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
          this.zoom = 14;
          this.currentLocation.lat = position.coords.latitude;
          this.currentLocation.lng = position.coords.longitude;
          this.map.setCenter(this.currentLocation);
          this.map.setZoom(this.zoom);
        });
      }
    },
    initializeHereMap() {
      const mapContainer = this.$refs.hereMap;
      const H = window.H;
      var maptypes = this.platform.createDefaultLayers();

      this.map = new H.Map(mapContainer, maptypes.vector.normal.map, {
        zoom: this.zoom,
        center: this.currentLocation
      });
      
      addEventListener("resize", () => this.map.getViewPort().resize());
      new H.mapevents.Behavior(new H.mapevents.MapEvents(this.map));
      H.ui.UI.createDefault(this.map, maptypes);
    },

    dropMarker(professionals) {
      // TODO: Redesign the icon to look good when there are many markers close to each other 
      const customMarkerSvg = '<svg xmlns="http://www.w3.org/2000/svg" height="25px" width="20px" viewBox="0 0 61.11 84.32"><defs><style>.cls-1{fill:#ba5532;}</style></defs><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1"><path class="cls-1" d="M30.55,25.28A18.18,18.18,0,0,0,12.38,43.45c0,13.62,13.63,36.33,18.17,40.87,4.54-4.44,18.35-27.25,18.17-40.87A18.27,18.27,0,0,0,30.55,25.28Zm6.2,24.82c-1.76.78-2.57-.67-6.21-.75s-4.6,1.37-6.34.5c-2-1-3-4-2.62-6.4.3-2,1.6-3.29,4.2-5.81,2.23-2.16,3.35-3.24,4.83-3.27,1.81,0,3.12,1.35,5.57,4,2.12,2.25,3.17,3.37,3.45,5.13C40,46,38.89,49.16,36.75,50.1Z"/><ellipse class="cls-1" cx="21.71" cy="11.21" rx="7.28" ry="11.21" transform="translate(-0.5 1.03) rotate(-2.68)"/><ellipse class="cls-1" cx="54.11" cy="26.31" rx="9.08" ry="6.49" transform="translate(7.94 64.89) rotate(-65.81)"/><ellipse class="cls-1" cx="39.33" cy="11.21" rx="11.21" ry="7.28" transform="translate(26.3 49.97) rotate(-87.32)"/><ellipse class="cls-1" cx="6.99" cy="26.31" rx="6.49" ry="9.08" transform="translate(-10.17 5.18) rotate(-24.19)"/></g></g></svg>'

      const H = window.H;
      let customMarker = new H.map.Icon(customMarkerSvg, {size: {w: 40, h: 50}});
      for(let i = 0; i < professionals.length; i++) {
        let marker = new H.map.Marker({ 
          lat: professionals[i].latitude, 
          lng: professionals[i].longitude},
          
          { icon: customMarker });
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