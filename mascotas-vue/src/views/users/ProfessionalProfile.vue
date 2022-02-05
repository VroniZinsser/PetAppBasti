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

          <h2>{{ professional.first_name }} {{ professional.last_name }}</h2>

          <div class="professional-types">
            <div v-for="type in professional.user_types" :key="type.id">
              {{ type.name }}
            </div>
          </div>
        </div>

        <div class="description" v-if="professional.description">
          <h3>Descripción</h3>

          <p>{{ professional.description }}</p>
        </div>
      </div>

      <aside :class="hasContact ? 'withContact' : ''">
        <div class="contact" v-if="hasContact">
          <h3>Contactar a {{ professional.first_name }}</h3>

          <ul class="contact-data-container">
            <ContactItem
                v-for="method in contactMethods"
                :key="method.contactData"
                :contactData="method.contactData"
                :link="method.link"
                :imgPath="method.imgPath"
                :alt="method.alt"
            />
          </ul>
        </div>
        <div class="location">
          <h3>Dirección</h3>
          <div>
            <span>{{ professional.street }} {{ professional.house_number }}</span>
            <span>{{ professional.postal_code }} {{ professional.district }} {{ professional.city }}</span>
            <span>{{ professional.state }}</span>
          </div>
          <a :href="googleMapsLink" target="_blank">
            <img :src="createStaticImgPath('contact/google-maps.png')" alt="Link a Google Maps">
            <span>Google Maps</span>
          </a>
        </div>
      </aside>
    </div>
  </div>
</template>

<script>
import ContactItem from "@/components/users/profile/professional/ContactItem";
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
    Loader,
    ContactItem,
  },
  data() {
    return {
      loading: true,
      professional: null,
      store,
      createImgPath,
      createStaticImgPath,
      contactMethods: [],
    }
  },
  mounted() {
    userServices.getUserById(this.$route.params.professional_id)
        .then(res => {
          if (res.data.user) {
            this.professional = res.data.user;
            this.contactMethods = [
              {
                'contactData': this.professional.whatsapp,
                'link': 'https://api.whatsapp.com/send?phone=' + this.professional.whatsapp,
                'imgPath': 'contact/whatsapp.png',
                'alt': 'link a Whatsapp'
              },
              {
                'contactData': this.professional.email,
                'link': 'mailto:' + this.professional.email,
                'imgPath': 'contact/gmail.png',
                'alt': 'link a Gmail'
              },
              {
                'contactData': this.professional.instagram,
                'link': 'https://www.instagram.com/' + this.professional.instagram,
                'imgPath': 'contact/instagram.png',
                'alt': 'link a Instagram'
              },
              {
                'contactData': this.professional.facebook,
                'link': 'https://www.facebook.com/' + this.professional.facebook,
                'imgPath': 'contact/facebook.png',
                'alt': 'link a Facebook'
              },
              {
                'contactData': this.professional.web,
                'link': this.professional.web,
                'imgPath': 'contact/www.png',
                'alt': 'link a la página web'
              }
            ],
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
