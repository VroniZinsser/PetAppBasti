<template>
  <v-container fluid>
    <Construction
        pageName="tu agenda"
        infoText="Aquí podrás ver todas tus tareas, ordenadas por fecha y horario"
    />
  </v-container>
</template>

<script>
import Construction from "@/components/general/layout/Construction"

export default {
  name: "Schedule",
  components: {
    Construction
  }
}
</script>