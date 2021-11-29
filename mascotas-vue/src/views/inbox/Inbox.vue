<template>
  <v-container>
    <construction
      pageName="tu casilla personal"
      infoText="Basti te permite compartir con un profesional la historia clínica de tu mascota y tus consultas programadas. Si compartiste alguna información la verás en este apartado."
    ></construction>  
  </v-container>
</template>

<script>
import Construction from "@/components/general/layouts/Construction" 
export default {
  name: "Inbox",
  components: {
    Construction
  }
}
</script>

<style scoped>

</style>
