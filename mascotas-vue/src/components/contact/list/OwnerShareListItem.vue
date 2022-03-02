<template>
  <div class="share-list-item">
    <div class="professional-container">
      <router-link
          :to="{name: 'ProfessionalProfile', params: { professional_id: professional.id }}"
      >
        {{ professional.first_name }} {{ professional.last_name }}
      </router-link>
    </div>

    <v-expansion-panels
        accordion flat
        :multiple="desktopUp"
        :disabled="desktopUp"
        :value="expandedItems(professional.requests_professional)"
    >
      <ShareListSubItem
          v-for="request in professional.requests_professional"
          :key="request.id"
          :request="request"
          :professionalName="professional.first_name"
      />
    </v-expansion-panels>
  </div>
</template>

<script>
import ShareListSubItem from "@/components/contact/list/ShareListSubItem";

export default {
  name: "OwnerSignUpForm",
  props: {
    professional: {
      type: Object,
      required: true,
    },
  },
  components: {
    ShareListSubItem,
  },
  computed: {
    /**
     * Returns true if the viewport width is >= 992px
     */
    desktopUp() {
      return this.$vuetify.breakpoint.lgAndUp;
    },
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
};
</script>

<style scoped>
</style>
