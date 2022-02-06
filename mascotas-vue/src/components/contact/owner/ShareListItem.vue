<template>
  <div class="share-list-item">
    <div class="professional-container">
      <p>{{ professional.first_name }} {{ professional.last_name }}</p>
      <a href="#">Ir al perfil</a>
    </div>
    <v-expansion-panels accordion flat>
      <ShareListSubitem
        v-for="request in professional.requests_professional"
        :key="request.id"
        :request="request"
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
};
</script>

<style scoped>
</style>
