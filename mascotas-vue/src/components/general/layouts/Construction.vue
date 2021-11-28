<template>
    <v-row class="construction" justify="center" align-content="center">
      <v-col>
        <v-img
          :src="getCompletePath('ui/construccion.png')"
          alt="Personas creando una página web"
          contain
          class="construction-img"
        ></v-img>
        <div class="info-container">
          <h2>Estamos trabajando para vos...</h2>
          <h3>En breve vas a ver aquí <strong>{{ pageName }}</strong></h3>
          <p>{{ infoText }}</p>
        </div>
      </v-col>
    </v-row>
</template>
<script>
import {PATH_IMG} from "@/constants";

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
  methods: {
    getCompletePath(path) {
      return PATH_IMG + path
    }
  }
}
</script>