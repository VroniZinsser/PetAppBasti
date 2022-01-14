<template>
  <v-list-item>
    <v-card>
      <v-card-subtitle>Expira: {{ request.expiration_date }}</v-card-subtitle>

      <v-card-text v-if="request.description">{{ request.description }}</v-card-text>

      <v-card-actions>
        <v-btn @click="$emit('request-update', request)">Editar</v-btn>
        <v-btn
            elevation="2"
            outlined
        >
          Eliminar
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-list-item>
</template>

<script>
export default {
  name: "ListItem",
  props: {
    request: {
      required: true,
      type: Object,
    }
  },

}
</script>

<style scoped>

</style>
