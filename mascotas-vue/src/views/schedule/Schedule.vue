<template>
  <v-container fluid>
    <construction
      pageName="tu agenda"
      infoText="Aquí podrás ver todas tus tareas, ordenadas por fecha y horario"
    ></construction>  
  </v-container>
</template>

<script>
import Construction from "@/components/general/layouts/Construction" 
export default {
  name: "Schedule",
  components: {
    Construction
  }
}
</script>

<style scoped>

</style>
