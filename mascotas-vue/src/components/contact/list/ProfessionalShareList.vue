<template>
  <ul>
    <ListItem
        v-for="request in sharedPets"
        :key="request.id"
        :request="request"
        :desktop-up="desktopUp"
        :expansion-panels-value="expandedItems(sharedPets)"
    />
  </ul>
</template>

<script>
import ListItem from "./ProfessionalShareListItem"

export default {
  name: "List",
  components: {ListItem},
  props: {
    sharedPets: {
      required: true,
      type: Array,
    }
  },
  data() {
    return {}
  },
  computed: {
    desktopUp() {
      return this.$vuetify.breakpoint.lgAndUp;
    },
  },
  methods: {
    expandedItems(requests) {
      return this.desktopUp ? requests.map((k, i) => i) : [];
    }
  },
  mounted() {
  }
}
</script>