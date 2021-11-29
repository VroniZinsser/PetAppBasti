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
      if (navigator.geolocation) {
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
      const customMarkerSvg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64.46 104.65"><defs><style>.cls-1{fill:#efe5dc;}.cls-2{fill:#ba5532;}</style></defs><path class="cls-1" d="M32.23,0A32.23,32.23,0,0,0,0,32.23C0,56.31,24.08,96.5,32.23,104.65c8-7.79,32.58-48.17,32.22-72.42A32.11,32.11,0,0,0,32.23,0Z"/><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1-2"><path class="cls-2" d="M32.18,35.42A18.2,18.2,0,0,0,14,53.62c0,13.6,13.6,36.3,18.2,40.9,4.5-4.4,18.4-27.2,18.2-40.9A18.14,18.14,0,0,0,32.18,35.42Zm6.3,24.8c-1.8.8-2.6-.7-6.2-.8s-4.6,1.4-6.3.5c-2-1-3-4-2.6-6.4.3-2,1.6-3.3,4.2-5.8,2.2-2.2,3.4-3.2,4.8-3.3,1.8,0,3.1,1.3,5.6,4,2.1,2.2,3.2,3.4,3.5,5.1C41.68,56.12,40.58,59.32,38.48,60.22Z"/><ellipse class="cls-2" cx="23.38" cy="21.32" rx="7.3" ry="11.2" transform="translate(-0.97 1.12) rotate(-2.68)"/><ellipse class="cls-2" cx="55.78" cy="36.44" rx="9.1" ry="6.5" transform="translate(-0.32 72.39) rotate(-65.81)"/><ellipse class="cls-2" cx="41.01" cy="21.36" rx="11.2" ry="7.3" transform="translate(17.75 61.33) rotate(-87.32)"/><ellipse class="cls-2" cx="8.68" cy="36.42" rx="6.5" ry="9.1" transform="translate(-14.16 6.75) rotate(-24.19)"/></g></g></svg>'

      const H = window.H;
      let customMarker = new H.map.Icon(customMarkerSvg, {size: {w: 32, h: 52}});
      for (let i = 0; i < professionals.length; i++) {
        let marker = new H.map.Marker({
              lat: professionals[i].latitude,
              lng: professionals[i].longitude
            },

            {icon: customMarker});
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
