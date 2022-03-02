<template>
  <v-autocomplete
      class="form-control"
      v-bind="$attrs"
      type="text"
      :id="identifier"
      :name="identifier"
      :items="address_suggestions"
      :label="$attrs.label + ($attrs.required === '' ? ' *' : '')"
      :search-input.sync="search_input"
      no-data-text="Sin resultados"
      v-model="address.location_id"
      :error="errors !== null"
      :messages="errors ? errors[0] : ''"
      :disabled="loading"
      outlined
      color="#3fb094"
  />
</template>

<script>
import {HEREMAPS_API_KEY} from "@/constants";

export default {
  name: "InputAddress",
  props: {
    identifier: {
      type: String,
    },
    errors: {
      default: null
    },
    loading: {
      default: false
    }
  },
  data: function () {
    return {
      address_suggestions: [],
      search_input: null,

      address: {
        country: null,
        state: null,
        city: null,
        postal_code: null,
        district: null,
        street: null,
        house_number: null,
        location_id: null,
        latitude: null,
        longitude: null,
      },
    }
  },
  watch: {
    /**
     * Request to the HERE maps api: Fetches address suggestions based on the user's input
     */
    search_input: function (value) {
      fetch(`https://autocomplete.geocoder.ls.hereapi.com/6.2/suggest.json?apiKey=${HEREMAPS_API_KEY}&query=${value}`)
          .then(result => result.json())
          .then(result => {
            if (result.suggestions && result.suggestions.length > 0) {
              this.address_suggestions = result.suggestions.map((suggestion) => {
                return {
                  'text': suggestion.label,
                  'value': suggestion.locationId,
                };
              });

            }
          }, error => {
            console.error(error);
          });
    },
    /**
     * Request to the HERE maps api: fetches exact address and geolocation, once the user selects an address from the dropdown
     */
    'address.location_id': function (location_id) {
      fetch(`https://geocoder.ls.hereapi.com/6.2/geocode.json?locationid=${location_id}&jsonattributes=1&gen=9&apiKey=${HEREMAPS_API_KEY}`)
          .then(res => res.json())
          .then(res => {
            if (res.response.view.length > 0 && res.response.view[0].result.length > 0) {
              const location = res.response.view[0].result[0].location;

              if (!location) {
                return;
              }

              if (location.displayPosition) {
                this.address.latitude = location.displayPosition.latitude;
                this.address.longitude = location.displayPosition.longitude;
              }

              if (location.address) {
                this.address.country = location.address.country;
                this.address.state = location.address.state;
                this.address.city = location.address.city;
                this.address.postal_code = location.address.postalCode;
                this.address.district = location.address.district;
                this.address.street = location.address.street;
                this.address.house_number = location.address.houseNumber;
              }

              this.$emit('update-address', this.address);
            }
          }, error => {
            console.error(error);
          });
    }
  },
}
</script>
