<template>
  <div class="map-container">
    <div class="map-container-inner" ref="hereMap"></div>
  </div>
</template>

<script>
import {HEREMAPS_API_KEY} from "@/constants/";
import {nameToDisplay} from "@/helpers";

export default {
  name: "Map",
  data() {
    return {
      platform: null,
      map: {},
      ui: {},
      geocodingService: {},
      zoom: 12,
      currentLocation: {
        lat: -34.606469,
        lng: -58.4258116
      },
      markers: [],
      professionalsByDistance: [],
      markerIcons: {
        'veterinary': '<svg xmlns="http://www.w3.org/2000/svg" height="30px" width="20px" viewBox="0 0 36.4 59.1"><defs><style>.cls-1{fill:#ba5532;}.cls-2{fill:#efe5dc;}</style></defs><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1"><path class="cls-1" d="M18.2,0A18.2,18.2,0,0,0,0,18.2C0,31.8,13.6,54.5,18.2,59.1c4.5-4.4,18.4-27.2,18.2-40.9A18.14,18.14,0,0,0,18.2,0Z"/><path class="cls-2" d="M19.31,30.91a.42.42,0,0,1-.24,0h-4c-.62,0-.88-.27-.88-.89,0-1.95,0-3.91,0-5.86,0-.17,0-.23-.22-.23H8.09c-.62,0-.89-.27-.89-.88V17A.75.75,0,0,1,8,16.19h5.71c.44,0,.44,0,.44-.46V10.07c0-.59.28-.86.87-.86h6.08a.75.75,0,0,1,.84.85c0,2,0,3.92,0,5.88,0,.21.05.26.26.25h5.86c.62,0,.88.26.88.88v4.26c-3.24-1.64-6.21-1.38-8.82,1.23a6.49,6.49,0,0,0-1.83,4A6.93,6.93,0,0,0,19.31,30.91Z"/><path class="cls-2" d="M30.71,26.64a5.49,5.49,0,1,0-6.69,6,1.92,1.92,0,0,1,.62.14h1.15a6.15,6.15,0,0,0,1-.17,6.42,6.42,0,0,0,1.26-.55,5.63,5.63,0,0,0,2.25-2.53,4.84,4.84,0,0,0,.42-1.63V26.74S30.72,26.68,30.71,26.64Zm-4.58-2.79a.76.76,0,0,1,1.23.28,1.27,1.27,0,0,1,.14.66,1.68,1.68,0,0,1-.56,1.3.75.75,0,0,1-1.25-.26A1.77,1.77,0,0,1,26.13,23.85ZM23.27,24a.74.74,0,0,1,1.13-.18A1.66,1.66,0,0,1,25,25.11a1.44,1.44,0,0,1-.25.88.73.73,0,0,1-1.11.15A1.72,1.72,0,0,1,23.27,24Zm-.48,4.05a.8.8,0,0,1-.89-.35,1.43,1.43,0,0,1-.31-1.3A.65.65,0,0,1,22.67,26a1.45,1.45,0,0,1,.59,1.13C23.26,27.63,23.08,27.94,22.79,28.05Zm3.8,2.31c-.38.17-.56-.15-1.35-.16s-1,.29-1.38.1a1.38,1.38,0,0,1-.57-1.38c.07-.43.35-.7.92-1.25s.72-.7,1-.7.68.29,1.22.85.68.72.75,1.1A1.41,1.41,0,0,1,26.59,30.36ZM28.32,28a.64.64,0,0,1-1-.39,1.48,1.48,0,0,1,.3-1.34.82.82,0,0,1,.92-.34.92.92,0,0,1,.45.91A1.5,1.5,0,0,1,28.32,28Z"/></g></g></svg>',
        'pet_shop': '<svg xmlns="http://www.w3.org/2000/svg" height="30px" width="20px" viewBox="0 0 36.4 59.1"><defs><style>.cls-1{fill:#ba5532;}.cls-2{fill:#efe5dc;}</style></defs><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1"><path class="cls-1" d="M18.2,0A18.2,18.2,0,0,0,0,18.2C0,31.8,13.6,54.5,18.2,59.1c4.5-4.4,18.4-27.2,18.2-40.9A18.14,18.14,0,0,0,18.2,0Zm6.3,24.8c-1.8.8-2.6-.7-6.2-.8s-4.6,1.4-6.3.5c-2-1-3-4-2.6-6.4.3-2,1.6-3.3,4.2-5.8C15.8,10.1,17,9.1,18.4,9c1.8,0,3.1,1.3,5.6,4,2.1,2.2,3.2,3.4,3.5,5.1C27.7,20.7,26.6,23.9,24.5,24.8Z"/><ellipse class="cls-1" cx="18.71" cy="19.14" rx="12.29" ry="12.05"/><path class="cls-2" d="M30.07,17.05v.7a3.56,3.56,0,0,1-.89,2,3.46,3.46,0,0,1-3.78,1,3.41,3.41,0,0,1-1.47-1c-.11-.13-.2-.12-.32,0a3.45,3.45,0,0,1-5.21,0c-.17-.19-.2-.19-.37,0a3.45,3.45,0,0,1-4.57.54,3.15,3.15,0,0,1-.64-.57c-.13-.16-.19-.15-.33,0a3.44,3.44,0,0,1-5,.21,3.5,3.5,0,0,1-1-3.51c.39-1.57.78-3.14,1.18-4.72a1.57,1.57,0,0,1,1.24-1.26,2.23,2.23,0,0,1,.37,0H27.19a1.54,1.54,0,0,1,1.58,1.19c.42,1.62.81,3.24,1.22,4.85C30,16.72,30,16.89,30.07,17.05Z"/><path class="cls-2" d="M7.85,22a4.89,4.89,0,0,0,2.2.46,4.69,4.69,0,0,0,2.42-.75.3.3,0,0,1,.37,0,4.88,4.88,0,0,0,5.21,0,.29.29,0,0,1,.33,0,4.91,4.91,0,0,0,5.24,0c.08,0,.15-.1.26,0a4.77,4.77,0,0,0,4.61.38l.1,0v7.75A1.49,1.49,0,0,1,27,31.31H21.39c-.18,0-.22-.05-.21-.22V25.62c0-.2,0-.24-.23-.24q-2.74,0-5.49,0c-.17,0-.21,0-.21.21,0,1.83,0,3.66,0,5.49,0,.19,0,.24-.24.24H9.47A1.49,1.49,0,0,1,7.85,29.7V22Z"/></g></g></svg>',
        'dog_sitter': '<svg xmlns="http://www.w3.org/2000/svg" height="30px" width="20px" viewBox="0 0 36.4 59.1"><defs><style>.cls-1{fill:#ba5532;}.cls-2{fill:#efe5dc;}</style></defs><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1"><path class="cls-1" d="M18.2,0A18.2,18.2,0,0,0,0,18.2C0,31.8,13.6,54.5,18.2,59.1c4.5-4.4,18.4-27.2,18.2-40.9A18.14,18.14,0,0,0,18.2,0Z"/><path class="cls-2" d="M13,29.26l-2,3.85a1.16,1.16,0,0,1-1.17.67,1.14,1.14,0,0,1-1-.76A1.3,1.3,0,0,1,9,31.87c.56-1.11,1.12-2.22,1.69-3.32a1.89,1.89,0,0,0,.21-.93c0-1.34,0-2.68,0-4a.88.88,0,0,0-.4-.81c-.6-.45-1.18-.92-1.75-1.4a1.19,1.19,0,1,1,1.46-1.84.71.71,0,0,1,.14.1,5.05,5.05,0,0,0,4.62,1.62c1.34-.13,2.71,0,4.07,0a1.83,1.83,0,0,1,1,.26c1.55.91,3.11,1.79,4.67,2.68a.6.6,0,0,1,.38.62c0,2.51,0,5,0,7.52,0,1.07-.65,1.65-1.51,1.4a1.19,1.19,0,0,1-.85-1.28c0-1.15,0-2.29,0-3.44,0-.32-.06-.43-.4-.43-2.16,0-4.33,0-6.49,0-.42,0-.39.13-.22.42.58,1,1.16,2,1.71,3A1.15,1.15,0,0,1,17,33.48a1.09,1.09,0,0,1-1.37.13,1.56,1.56,0,0,1-.58-.69Z"/><path class="cls-2" d="M28.4,23a3.08,3.08,0,0,1-1.48-.36.74.74,0,0,0-1.08.24c-.38.54-.74.53-1.3.18-1.31-.81-2.67-1.55-4-2.3-.32-.18-.37-.3-.15-.62.87-1.26,1.76-2.5,2.54-3.82a10.81,10.81,0,0,0,.82-1.88c.16-.47.39-.91,1-.86s.85.45,1,.95a2.88,2.88,0,0,1,0,1.37.65.65,0,0,0,.35.75,3.59,3.59,0,0,1,1.19,1.23,3.49,3.49,0,0,0,1.67,1.41,5.48,5.48,0,0,1,1.39.79,1.37,1.37,0,0,1,.06,2.32A2.84,2.84,0,0,1,28.4,23Z"/><rect class="cls-2" x="13.54" y="6.16" width="1.13" height="15.72" rx="0.57" transform="translate(-5.73 12.68) rotate(-40.97)"/></g></g></svg>',
        'default': '<svg xmlns="http://www.w3.org/2000/svg" height="30px" width="20px" viewBox="0 0 64.46 104.65"><defs><style>.cls-1{fill:#efe5dc;}.cls-2{fill:#ba5532;}</style></defs><path class="cls-1" d="M32.23,0A32.23,32.23,0,0,0,0,32.23C0,56.31,24.08,96.5,32.23,104.65c8-7.79,32.58-48.17,32.22-72.42A32.11,32.11,0,0,0,32.23,0Z"/><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1-2"><path class="cls-2" d="M32.18,35.42A18.2,18.2,0,0,0,14,53.62c0,13.6,13.6,36.3,18.2,40.9,4.5-4.4,18.4-27.2,18.2-40.9A18.14,18.14,0,0,0,32.18,35.42Zm6.3,24.8c-1.8.8-2.6-.7-6.2-.8s-4.6,1.4-6.3.5c-2-1-3-4-2.6-6.4.3-2,1.6-3.3,4.2-5.8,2.2-2.2,3.4-3.2,4.8-3.3,1.8,0,3.1,1.3,5.6,4,2.1,2.2,3.2,3.4,3.5,5.1C41.68,56.12,40.58,59.32,38.48,60.22Z"/><ellipse class="cls-2" cx="23.38" cy="21.32" rx="7.3" ry="11.2" transform="translate(-0.97 1.12) rotate(-2.68)"/><ellipse class="cls-2" cx="55.78" cy="36.44" rx="9.1" ry="6.5" transform="translate(-0.32 72.39) rotate(-65.81)"/><ellipse class="cls-2" cx="41.01" cy="21.36" rx="11.2" ry="7.3" transform="translate(17.75 61.33) rotate(-87.32)"/><ellipse class="cls-2" cx="8.68" cy="36.42" rx="6.5" ry="9.1" transform="translate(-14.16 6.75) rotate(-24.19)"/></g></g></svg>',
      },
      nameToDisplay,
    };
  },
  props: {
    selectedProfessionalId: {
      type: Number
    }
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
      this.ui = H.ui.UI.createDefault(this.map, maptypes);
    },

    /**
     * Creates and displays markers on the map 
     * @param {Array} professionals - The array of users that should be displayed
     * @param {Number} userTypeId - The id of the filtered user type, null if users are not filtered by any type
     */
    dropMarker(professionals, userTypeId) {
      const H = window.H;
      this.map.removeObjects(this.map.getObjects ());
      this.removeInfoBubbles();
      
      for (let i = 0; i < professionals.length; i++) {
        const prof = professionals[i];
        // if the professionals are filtered by a certain type, use that type for the marker icons
        // if not, use the first user type of every professional
        const typeIdForIcon = userTypeId || prof.user_types[0].id;
        const markerIcon = new H.map.Icon(this.getIconByUserType(typeIdForIcon), {size: {w: 32, h: 52}});

        let userTypesString = '';

        for (const userType of prof.user_types) {
          if (userType.id !== 4) {
            userTypesString += `<span class="professional-type-tag">${userType.name}</span> `
          }
        }
        let marker = new H.map.Marker(
          {
            lat: prof.latitude,
            lng: prof.longitude
          }, 
          {
            icon: markerIcon
          }
        );
        marker.setData({
          prof_id: prof.id,
          content: `<div class="professional-card-header">
              ${userTypesString}
          </div>

          <div class="professional-card-content">
              <p class="professional-name">${this.nameToDisplay(prof)}</p>

              <p class="professional-location">${prof.city}, ${prof.street} ${prof.house_number}</p>

              <p class="professional-card-link-content"><a href="#/profesionales/${prof.id}">Ir al perfil</a></p>
          </div>`
        });
        marker.addEventListener('tap', event => {
          this.showInfoBubble(event.target);
          this.$emit('select-professional', event.target.getData().prof_id)
        }, false);

        this.markers.push(marker);
        this.map.addObject(marker);
        prof.distance = marker.getGeometry().distance(this.currentLocation);
      }

      this.professionalsByDistance = professionals.sort((a, b) => {
        return a.distance - b.distance;
      })
      this.$emit('sort-professionals', this.professionalsByDistance);
    },

    removeInfoBubbles() {
      this.ui.getBubbles().forEach(bubble => this.ui.removeBubble(bubble));
    },

    showInfoBubble(marker) {
      const H = window.H;
      this.removeInfoBubbles();
      var bubble = new H.ui.InfoBubble(marker.getGeometry(), {
        content: marker.getData().content
      });
      this.ui.addBubble(bubble);
    },

    getIconByUserType(userTypeId) {
      let icon;
      switch (userTypeId) {
        case 5:
        case 6:
          icon = this.markerIcons.veterinary;
          break;
        case 7:
          icon = this.markerIcons.dog_sitter;
          break;
        case 8:
          icon = this.markerIcons.pet_shop;
          break;
        default:
          icon = this.markerIcons.default;
      }
      return icon;
    }
  },

  watch: {
    selectedProfessionalId: function (professional_id) {      
      let index = this.markers.findIndex((item) => {
        return item.getData().prof_id === professional_id;
      });

      if (index !== -1) {
        this.showInfoBubble(this.markers[index]);
      }
    }
  }
};
</script>

<style scoped>

</style>
