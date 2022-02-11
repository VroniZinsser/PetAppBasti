<template>
  <Loader v-if="loading"></Loader>

  <v-container v-else fluid>
    <h1 class="sr-only">Aceptar petición</h1>

    <v-card>

    </v-card>
  </v-container>
</template>

<script>
import Loader from "@/components/general/notifications/Loader";
import contactService from "@/services/contact";

export default {
  name: "Accept",
  components: {Loader},
  data: () => ({
    loading: true,
  }),
  mounted() {
    contactService.acceptGenerate(this.$route.params.request_id)
    .then(res => {
      if("access" in res){
        this.$router.push({name: 'Pets'})
      }
    })

    this.loading = false;
  }
}
</script>