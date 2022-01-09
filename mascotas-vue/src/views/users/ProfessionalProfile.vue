<template>
    <Loader v-if="loading"></Loader>
    <div v-else class="professional-profile">
        <TitleBar :title="professional.public_name"></TitleBar>
        <div class="intro">
            <div>
                <img :src="createImgPath(professional.profile_image.src)" :alt="professional.profile_image.alt">
            </div>
            <h2>{{ professional.first_name}} {{ professional.last_name }}</h2>
            <div class="professional-types">
                <div v-for="type in professional.user_types" :key="type.id">
                    {{type.name}}
                </div>
            </div>
        </div>
        <div class="description">
            <h3>Descripción</h3>
            <p>{{ professional.description }}</p>
        </div>
        <div class="location">
            <div class="location-header">
                <a :href="googleMapsLink" target="_blank">Google Maps</a>
            </div>
            <div class="location-body">
                <div>
                    <img :src="createStaticImgPath('ui/marker.svg')" alt="Ícono de geolocalización">
                </div>
                <div>
                    <span>{{ professional.street }} {{ professional.house_number }}</span>
                    <span>{{ professional.postal_code }} {{ professional.district }} {{ professional.city }}</span>
                    <span>{{ professional.state }}</span>
                </div>
            </div>
        </div>
        
        <div class="contact">
            <v-expansion-panels>
                <v-expansion-panel>
                    <v-expansion-panel-header>
                        Contactar
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <div v-if="professional.whatsapp">{{ professional.whatsapp }}</div>
                        <div v-if="professional.email && professional.email_visible">{{ professional.email }}</div>
                        <div v-if="professional.instagram">{{ professional.instagram }}</div>
                        <div v-if="professional.facebook">{{ professional.facebook }}</div>
                        <div v-if="professional.web">{{ professional.web }}</div>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </div>
    </div>
</template>

<script>
import {createImgPath} from "@/helpers";
import {createStaticImgPath} from "@/helpers";
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
            createImgPath,
            createStaticImgPath,
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
    },
    computed: {
        googleMapsLink() {
            const directions = this.whiteSpacesToPlus(
                this.professional.street + '+'
                + this.professional.house_number + '+'
                + this.professional.postal_code + '+'
                + this.professional.city + '+'
                + this.professional.state
            )
            return 'https://www.google.com.ar/maps/dir//' + directions;
        }
    },
    methods: {
        whiteSpacesToPlus(str) {
            return str.replace(/\s/g, '+');
        }
    }
}
</script>
