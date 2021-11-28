<template> 
    <div class="no-pet">
        <v-row class="inner" justify="center" align-content="center">
            <div>
                <p>No agregaste ninguna mascota aún.</p>
                <v-img 
                    :src="getCompletePath('ui/no_pet.png')" 
                    alt="Mujer jugando con un perrito"
                    max-width="300"
                    class="no-pet-img"
                    @click="showImgAlert = !showImgAlert">
                </v-img>
                
            </div>
        </v-row>
        <ImageSourceNotification :show="showImgAlert">
            Gracias a <a href='https://www.freepik.com/vectors/people' target="_blank">pikisuperstar</a> por la ilustración
        </ImageSourceNotification>
    </div>

</template>
<script>
import {PATH_IMG} from "@/constants";
import ImageSourceNotification from "@/components/general/notifications/ImageSourceNotification"

export default {
  name: "NoPet",
  data: () => ({
    showImgAlert: false,
  }),
  components: {ImageSourceNotification},
  methods: {
    getCompletePath(path) {
      return PATH_IMG + path
    }
  }
  }
</script>
