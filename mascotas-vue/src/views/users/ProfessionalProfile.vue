<template>
    <Loader v-if="loading"></Loader>
    <div v-else>
        <TitleBar :title="professional.public_name"></TitleBar>
    </div>
</template>

<script>
import TitleBar from "@/components/general/layouts/TitleBar";
import userServices from "@/services/users";
import store from "@/store";
import Loader from "@/components/general/notifications/Loader";

export default {
    name: "ProfessionalProfile",
    components: {
        TitleBar,
        Loader
    },
    data() {
        return {
            loading: true,
            professional: null,
            store,
        }
    },
    mounted() {
        userServices.getUserById(this.$route.params.professional_id)
            .then(res => {
                if (res.data.user) {
                    this.professional = res.data.user;
                    this.loading = false;                    
                } else {
                    this.store.setStatus({
                        msg: 'El perfil que estás buscando no está disponible.',
                        type: 'error',
                    });
                    this.$router.go(-1);                  
                }
            });
    }
}
</script>
