<template>
  <InputText
      v-model="searchString"
      :loading="loading"
      label="Buscar"
      identifier="search"
      prepend-inner-icon="mdi-magnify"
  />
</template>

<script>
import InputText from "@/components/general/input/InputText";

export default {
  name: "ExploreSearchBar",
  components: {
    InputText,
  },
  props: {
    professionals: {
      type: Array,
      required: true,
    },
    loading: {
      type: Boolean,
      default: false,
    }
  },
  data() {
    return {
      searchString: null,
      filteredProfessionals: [],
    }
  },
  watch: {
    searchString(query) {
      this.filterProfessionalsByQuery(query);

      this.$emit('filter-by-query', this.filteredProfessionals);
    }
  },
  methods: {
    /**
     * Adds all professionals to the filtered list whose content data contains the given query
     * @param query | string
     */
    filterProfessionalsByQuery(query) {
      this.filteredProfessionals = [];

      this.professionals.forEach((prof) => {
        if (this.containsIgnoreCase(query, prof.state, prof.city, prof.district, prof.street, prof.public_name, prof.first_name, prof.last_name, prof.description)) {
          this.filteredProfessionals.push(prof);
        }
      })
    },

    /**
     * Returns true if the query appears at least once in the given strings, ignoring the case
     * @param query | string
     * @param strings | ...string
     */
    containsIgnoreCase(query, ...strings) {
      const joinedString = strings.join(' ');

      return (joinedString && joinedString.toLowerCase().indexOf(query.toLowerCase()) !== -1)
    }
  }
}
</script>