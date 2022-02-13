<template>
  <Loader v-if="loading"></Loader>

  <v-container v-else-if="request" fluid class="justify-center d-flex align-center">
    <h1 class="sr-only">Aceptar petición</h1>

    <AcceptCard
        v-if="incomplete"
        :request="request"
        @accepted="accepted"
        @rejected="rejected"
    />

    <TitleWithLink
        v-else
        :title="result.title"
        :link-text="result.linkText"
        :route-name="result.routeName"
    />
  </v-container>

  <TitleWithLink
      v-else
      title="Este enlace no es válido, le podes pedir al dueño de la mascota que te la comparta nuevamente."
      link-text="Ir al inicio"
      route-name="Pets"
  />
</template>

<script>
import Loader from "@/components/general/notifications/Loader";
import contactService from "@/services/contact";
import AcceptCard from "@/components/contact/requests/AcceptCard";
import TitleWithLink from "@/components/general/layouts/TitleWithLink";

export default {
  name: "Accept",
  components: {TitleWithLink, AcceptCard, Loader},
  data: () => ({
    loading: true,
    request: null,
    incomplete: true,
    notification: {
      text: null,
      type: 'success',
    },
    result: {
      title: null,
      linkText: null,
      routeName: null,
    }
  }),
  methods: {
    accepted() {
      this.result = {
        title: 'Petición aceptada con éxito',
        linkText: 'Ir al inicio',
        routeName: 'Pets', // NOTE: Esto es temporal, cuando este completa la pantalla de inicio para el profesional se debe de poner el route name correspondiente
      }

      this.incomplete = false;
    },

    rejected() {
      this.result = {
        title: 'Petición rechazada con éxito',
        linkText: 'Ir al inicio',
        routeName: 'Pets', // NOTE: Esto es temporal, cuando este completa la pantalla de inicio para el profesional se debe de poner el route name correspondiente
      }

      this.incomplete = false;
    },
  },
  mounted() {
    contactService.acceptGenerate(this.$route.params.request_id)
        .then(res => {
          if (!("access" in res)) {
            this.request = res.data.request;
          }

          this.loading = false;
        })
  }
}
</script>