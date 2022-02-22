<template>
  <v-container>
    <v-row class="construction" justify="center" align-content="center">
      <v-col>
        <v-img
            :src="createStaticImgPath('ui/page_not_found.png')"
            alt="Error 404, no se encontró la página solicitada"
            contain
            class="construction-img"
        ></v-img>
        <div class="info-container">
          <p class="text-h5 ">No se encontró la página solicitada</p>
          <p><router-link :to="{name: 'Pets'}" class="text-h6 font-weight-regular">Volver al inicio</router-link></p>
        </div>
      </v-col>
    </v-row>

    <p>No se encontró la página</p>
    <p>
      <router-link to="/">Volver al inicio</router-link>
    </p>
  </v-container>
</template>

<script>
import {createStaticImgPath} from "@/helpers";

export default {
  name: "PageNotFound",
  components: {},
  props: {},
  data() {
    return {
      createStaticImgPath,
    }
  },
  methods: {},
  mounted() {
  }
}
</script>