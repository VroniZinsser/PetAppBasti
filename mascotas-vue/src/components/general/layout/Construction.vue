<template>
  <v-row class="construction" justify="center" align-content="center">
    <v-col>
      <v-img
          :src="createStaticImgPath('ui/construccion.png')"
          alt="Personas creando una página web"
          contain
          class="construction-img"
      />

      <div class="info-container">
        <h2>Estamos trabajando para vos...</h2>

        <h3>En breve vas a ver aquí <strong>{{ pageName }}</strong></h3>

        <p>{{ infoText }}</p>
      </div>
    </v-col>
  </v-row>
</template>

<script>
import {createStaticImgPath} from "@/helpers";

export default {
  name: "Construction",
  props: {
    pageName: {
      type: String,
      required: true
    },
    infoText: {
      type: String,
    },
  },
  data: () => ({
    createStaticImgPath,
  }),
}
</script>