
<template>
  <div id="map">
  <!--In the following div the HERE Map will render-->
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
    // Initialize the platform object:
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
    initializeHereMap() { // rendering map

      const mapContainer = this.$refs.hereMap;
      const H = window.H;
      // Obtain the default map types from the platform object
      var maptypes = this.platform.createDefaultLayers();

      // Instantiate (and display) a map object:
      this.map = new H.Map(mapContainer, maptypes.vector.normal.map, {
        zoom: 10,
        center: this.currentLocation
        // center object { lat: 40.730610, lng: -73.935242 }
      });
      

      addEventListener("resize", () => this.map.getViewPort().resize());

      // add behavior control
      new H.mapevents.Behavior(new H.mapevents.MapEvents(this.map));

      // add UI
      H.ui.UI.createDefault(this.map, maptypes);
      // End rendering the initial map
    },
    dropMarker() {
        const H = window.H;
        // Con el nombre "CABA" no reconoce la ciudad. Con "Buenos Aires" sí. 
        let directions = [
            "Av. Corrientes 6335, Buenos Aires",
            "Av. Corrientes 4411, Buenos Aires",
            "Humahuaca 4327, C1192 ACI, Buenos Aires",
            "Estado de Palestina 876, C1182 ADH, Buenos Aires",
            "Bacacay 412, B1714ERB Gran Buenos Aires, Provincia de Buenos Aires",
            "Sáenz Peña 2519, Bahía Blanca, Provincia de Buenos Aires",
            "Av. Lainez 1812, B8001DDJ Bahía Blanca, Provincia de Buenos Aires",
            "Av. del Libertador 378, Z9405 El Calafate, Santa Cruz",
            "25 de Mayo 599-699, Puerto San Julian, Santa Cruz",
            "Juan José Paso, Río Gallegos, Santa Cruz",
            "6P5M+7M Ushuaia, Tierra del Fuego Province",
            "Kuanip 966, V9410 BQT, Tierra del Fuego",
            "Juan Facundo Quiroga 2652, Ushuaia, Tierra del Fuego",
            "Cabo Peña 747, Río Grande, Tierra del Fuego",
            "Rafael Obligado 1245, 9640, Río Grande, Tierra del Fuego",
            "Pte Ill a 686, San Salvador de Jujuy, Jujuy",
            "Leandro N. Alem 642, Y4607 San Salvador de Jujuy, Jujuy",
            "Gral. Justo José de Urquiza 859, Federal, Entre Ríos",
            "Av. Los Constituyentes 1750, Crespo, Entre Ríos"

        ]

        for (let i = 0; i < directions.length; i++) {
            this.geocodingService.geocode({ searchText: directions[i] }, data => {
                
                if(data.Response.View.length > 0) {
                    if (data.Response.View[0].Result.length > 0) {
                        let position = data.Response.View[0].Result[0].Location.DisplayPosition;
                        let marker = new H.map.Marker({ lat:position.Latitude, lng:position.Longitude});
                        this.map.addObject(marker);
                    }
                }
            }, error => {
                console.log(error);
            });
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