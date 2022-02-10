<template>
  <div class="share-list-item">
    <div class="professional-container">
      <a href="#">{{ professional.first_name }} {{ professional.last_name }}</a>
    </div>
    <v-expansion-panels 
      accordion flat 
      :multiple="desktopUp"
      :disabled="desktopUp"
      :value="expandedItems(professional.requests_professional)"
    >

      <ShareListSubitem
        v-for="request in professional.requests_professional"
        :key="request.id"
        :request="request"
        :professionalName="professional.first_name"
      />
    </v-expansion-panels>
  </div>
</template>

<script>
import ShareListSubitem from "@/components/contact/owner/ShareListSubitem";

export default {
  name: "ShareListItem",
  props: {
    professional: {
      type: Object,
      required: true,
    },
  },
  components: {
    ShareListSubitem,
  },

  methods: {
    /**
     * Returns [] for small screens and [0,1,2,...] for desktop screens, counting all requests related to one professional
     * With this method all panels will be expanded by default on bigger screens
     */
    expandedItems(requests) {
      return this.desktopUp ? requests.map((k, i) => i) : [];
    }
  },
  computed: {
    /**
     * Returns true if the viewport width is >= 992px
     */
    desktopUp() {
      return this.$vuetify.breakpoint.lgAndUp;
    },
    
  }
};
</script>

<style scoped>
</style>
