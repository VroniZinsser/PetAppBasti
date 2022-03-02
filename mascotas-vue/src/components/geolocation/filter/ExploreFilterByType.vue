<template>
  <v-select
      v-model="userTypeId"
      :items="userTypes"
      :disabled="loading"
      item-text="name"
      item-value="id"
      label="Tipo de profesional"
      prepend-inner-icon="mdi-filter"
      outlined
  />
</template>

<script>
export default {
  name: "ExploreFilterByType",
  props: {
    professionals: {
      type: Array,
      required: true,
    },
    userTypes: {
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
      userTypeId: null,
      filteredProfessionals: [],
    }
  },
  watch: {
    userTypeId(id) {
      this.filterProfessionalsByType(id);
    }
  },
  methods: {
    /**
     * Adds all professionals to the filtered list whose user types contain the given user type id
     */
    filterProfessionalsByType(typeId) {
      if (typeId === -1) {
        this.filteredProfessionals = this.professionals;

        this.$emit('filter-by-type', this.filteredProfessionals);
      } else {
        this.filteredProfessionals = [];

        this.professionals.forEach((professional) => {
          professional.user_types.forEach((type) => {
            if (type.id === typeId) {
              this.filteredProfessionals.push(professional);
            }
          })
        });

        this.$emit('filter-by-type', this.filteredProfessionals, typeId);
      }
    },
  }
}
</script>