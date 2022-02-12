<template>
  <v-card width="500px" height="fit-content">
    <v-card-title>{{ request.owner.first_name }} {{ request.owner.last_name }}</v-card-title>
    <v-divider></v-divider>

    <v-container>
      <div>
        <p>Mascota: {{ request.pet.name }}</p>
        <p>Fecha de expiración: {{ request.expiration_date }}</p>
      </div>

      <div v-if="request.description">
        <p><span class="sr-only">Descripción de la petición: </span>{{ request.description }}</p>
      </div>
    </v-container>

    <v-divider></v-divider>

    <v-card-actions class="justify-center pt-4 pb-4">
      <v-btn
          color="error"
          outlined
          @click="decline"
      >
        Rechazar
      </v-btn>

      <v-btn
          color="success"
          @click="accept"
      >
        Aceptar
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import contactService from "@/services/contact";

export default {
  name: "AcceptCard",
  props: {
    request: {
      required: true,
      type: Object,
    }
  },
  methods: {
    accept() {
      contactService.accept(this.request.id)
          .then(() => {
            this.$emit('accepted')
          })
    },

    decline() {
      contactService.delete(this.request.id)
          .then(() => {
            this.$emit('rejected')
          })
    }
  }
}
</script>