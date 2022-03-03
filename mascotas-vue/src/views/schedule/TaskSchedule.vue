<template>
  <v-container fluid>
    <ConstructionPage
        pageName="tu agenda"
        infoText="Aquí podrás ver todas tus tareas, ordenadas por fecha y horario"
    />
  </v-container>
</template>

<script>
import ConstructionPage from "@/components/general/layout/ConstructionPage"

export default {
  name: "TaskSchedule",
  components: {
    ConstructionPage
  }
}
</script>