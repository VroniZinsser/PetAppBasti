<template>
  <div>
    <TitleBar :title="loading ? '' : 'Perfil de ' + pet.name"/>

    <TheLoader v-if="loading"/>

    <div v-else>
      <div>
        <BaseNotification
            v-if="store.status.msg != null"
            :type="store.status.type"
            :text="store.status.msg"
            :title="store.status.title"
        />

        <PetDetail :pet="pet" />
      </div>
    </div>
  </div>
</template>

<script>
import petServices from '@/services/pets';
import BaseNotification from "@/components/general/notification/BaseNotification";
import PetDetail from "@/components/pet/show/detail/PetDetail";
import store from "@/store";
import TheLoader from "@/components/general/layout/TheLoader";
import TitleBar from "@/components/general/layout/TitleBar";
import {handleAccessError, handleAuthenticationError} from "@/helpers";

export default {
    name: "PetShared",
    components: {
        BaseNotification,
        PetDetail,
        TheLoader,
        TitleBar
    },
    data() {
        return {
            pet: null,
            store,
            handleAccessError,
            handleAuthenticationError,
            loading: true,
        }
    },
    mounted() {
        petServices.find(this.$route.params.pet_id)
            .then(res => {
                this.loading = false;

                if (!res.data) {
                    if (this.handleAuthenticationError(res)) return;
                    if (this.handleAccessError(res)) return;

                    this.store.setStatus({
                      msg: "No se pudo encontrar la mascota.",
                      type: 'error',
                    });

                    this.$router.back();
                } else {
                    this.pet = res.data.pet;
                }                
            })

    }

}
</script>