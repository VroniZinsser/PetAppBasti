<template>
    <div>
        <TitleBar :title="professional.public_name"></TitleBar>
    </div>
</template>

<script>
import TitleBar from "@/components/general/layouts/TitleBar";
import userServices from "@/services/users";

export default {
    name: "ProfessionalProfile",
    components: {
        TitleBar,
    },
    data() {
        return {
            loading: false,
            professional: null,
        }
    },
    mounted() {
        this.loading = true,
        userServices.getUserById(this.$route.params.professional_id)
            .then(res => {
                this.professional = res.data.user;
                this.loading = false;
            });
    }
}
</script>
