<template>
    <Loader v-if="loading"></Loader>
    <div v-else class="professional-profile">
        <TitleBar :title="professional.public_name"></TitleBar>
        <div class="profile-container">
            <div class="profile-main-content">
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
            
                <div class="description" v-if="professional.description">
                    <h3>Descripción</h3>
                    <p>{{ professional.description }}</p>
                </div>
            </div>

            <aside>  
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
                    
                <div class="contact" v-if="hasContact">
                    <h3>Contactar a {{ professional.first_name }}</h3>
                    <ul class="contact-data-container">
                        <li v-if="professional.whatsapp">
                            <a :href="'https://api.whatsapp.com/send?phone=' + professional.whatsapp" target="_blank">
                                <img :src="createStaticImgPath('contact/whatsapp.png')" alt="link a Whatsapp">
                                <span>{{ professional.whatsapp }}</span>
                            </a>
                        </li>
                        <li v-if="professional.email && professional.email_visible">
                            <a :href="'mailto:' + professional.email" target="_blank">
                                <img :src="createStaticImgPath('contact/gmail.png')" alt="link a Gmail">
                                <span>{{ professional.email }}</span>
                            </a>
                        </li>
                        <li v-if="professional.instagram">
                            <a :href="'https://www.instagram.com/' + professional.instagram" target="_blank">
                                <img :src="createStaticImgPath('contact/instagram.png')" alt="link a Instagram">
                                <span>{{ professional.instagram }}</span>
                            </a>
                        </li>
                        <li v-if="professional.facebook">
                            <a :href="'https://www.facebook.com/' + professional.facebook" target="_blank">
                                <img :src="createStaticImgPath('contact/facebook.png')" alt="link a Facebook">
                                <span>{{ professional.facebook }}</span>
                            </a>
                        </li>
                        <li v-if="professional.web">
                            <a :href="professional.web" target="_blank">
                                <img :src="createStaticImgPath('contact/www.png')" alt="link a la página web">
                                <span>{{ professional.web }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>  
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
        },

        /** Returns true if any of the contact methods is set */
        hasContact() {
            return this.professional.whatsapp
                || (this.professional.email && this.professional.email_visible)
                || this.professional.instagram
                || this.professional.facebook
                || this.professional.web;
        }
    },
    methods: {
        whiteSpacesToPlus(str) {
            return str.replace(/\s/g, '+');
        }
    }
}
</script>
