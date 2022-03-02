<template>
  <li class="share-list-item">
    <v-expansion-panels
        accordion flat
        :multiple="desktopUp"
        :disabled="desktopUp"
        :value="expansionPanelsValue"
    >

      <ShareListSubItem
          :request="request"
      />
    </v-expansion-panels>
  </li>
</template>

<script>
import ShareListSubItem from "@/components/contact/list/ShareListSubItem";

export default {
  name: "ProfessionalShareListItem",
  components: {ShareListSubItem},
  props: {
    request: {
      type: Object,
      required: true,
    },
    desktopUp: {
      required: true,
    },
    expansionPanelsValue: {
      required: true,
    }
  },
  data() {
    return {}
  },
  methods: {},
  mounted() {
  }
}
</script>

<style scoped type="text/scss">
.share-list-item{
  border-bottom: 1px solid rgba(51, 51, 51, 0.4);
}
</style>