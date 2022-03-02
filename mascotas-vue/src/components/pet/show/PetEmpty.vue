<template> 
    <div class="no-pet">
        <v-row class="inner" justify="center" align-content="center">
            <div>
                <p>No agregaste ninguna mascota aún.</p>
                <v-img 
                    :src="createStaticImgPath('ui/no_pet.png')" 
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
import ImageSourceNotification from "@/components/general/notification/BaseNotificationImageSource"
import {createStaticImgPath} from "@/helpers"; 

export default {
  name: "NoPet",
  data: () => ({
    showImgAlert: false,
    createStaticImgPath,
  }),
  components: {ImageSourceNotification},
}
</script>
