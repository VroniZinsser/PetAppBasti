<template>
  <Loader v-if="loading"></Loader>

  <div v-else class="professional-profile">
    <TitleBar :title="nameToDisplay(professional)"></TitleBar>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />

    <div class="profile-container">
      <PetShareDialog 
        :showDialog="showPetShareDialog"
        :professionalName="professional.first_name"
        :professionalId="professional.id"
        @closeDialog="showPetShareDialog = false"
      />
      
      <div class="profile-main-content">
        <button 
          v-if="!isProfessional"
          class="float-circle-btn" 
          @click="showPetShareDialog = true"
        >
          <img :src="createStaticImgPath('contact/share-pet.svg')" alt="Compartir mascota">
          <span class="sr-only">Compartir mascota con este profesional</span>
        </button>
        <button 
          v-if="canEditProfile"
          class="float-circle-btn" 
          @click="function() { 
            $router.push({ name: 'ProfessionalEdit' })
          }">
          <v-icon>mdi-pencil</v-icon>
          <span class="sr-only">Editar perfil</span>
        </button>
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

      <aside>
        <div class="contact" v-if="hasContact">
          <h3>Contactar a {{ professional.first_name }}</h3>

          <ul class="contact-data-container">
            <ContactItem
                v-for="method in contactMethods"
                :key="method.name"
                :contactData="method.contactData"
                :link="method.link"
                :imgPath="method.imgPath"
                :alt="method.alt"
            />
          </ul>
        </div>
        <div class="location">
          <h3>Dirección</h3>
          <Address :professional="professional" />
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
import PetShareDialog from "@/components/contact/requests/PetShareDialog";
import ContactItem from "@/components/users/professionals/ContactItem";
import {createImgPath} from "@/helpers";
import {createStaticImgPath} from "@/helpers";
import TitleBar from "@/components/general/layouts/TitleBar";
import userServices from "@/services/users";
import store from "@/store";
import Loader from "@/components/general/notifications/Loader";
import {nameToDisplay} from "@/helpers";
import Address from "@/components/users/professionals/Address";
import BaseNotification from "@/components/general/notifications/BaseNotification";

export default {
  name: "ProfessionalProfile",
  components: {
    TitleBar,
    Loader,
    ContactItem,
    PetShareDialog,
    Address,
    BaseNotification,
  },
  data() {
    return {
      loading: true,
      professional: null,
      store,
      createImgPath,
      createStaticImgPath,
      contactMethods: [],
      showPetShareDialog: false,
      nameToDisplay,
    }
  },
  mounted() {
    this.loadUserProfile();
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
    },

    /** Returns true if the logged in user has the same id as the profile's user */
    canEditProfile() {
      return this.professional.id === this.store.user.id;
    },

    isProfessional() {
      return store.user.is_professional;
    }
  },
  methods: {
    whiteSpacesToPlus(str) {
      return str.replace(/\s/g, '+');
    },
    loadUserProfile() {
      userServices.getUserById(this.$route.params.professional_id)
        .then(res => {
          if (res.data.user) {
            this.professional = res.data.user;
            this.contactMethods = [
              {
                'name': 'whatsapp',
                'contactData': this.professional.whatsapp,
                'link': 'https://api.whatsapp.com/send?phone=' + this.professional.whatsapp,
                'imgPath': 'contact/whatsapp.png',
                'alt': 'link a Whatsapp'
              },
              {
                'name': 'email',
                'contactData': this.professional.email,
                'link': 'mailto:' + this.professional.email,
                'imgPath': 'contact/gmail.png',
                'alt': 'link a Gmail'
              },
              {
                'name': 'instagram',
                'contactData': this.professional.instagram,
                'link': 'https://www.instagram.com/' + this.professional.instagram,
                'imgPath': 'contact/instagram.png',
                'alt': 'link a Instagram'
              },
              {
                'name': 'facebook',
                'contactData': this.professional.facebook,
                'link': 'https://www.facebook.com/' + this.professional.facebook,
                'imgPath': 'contact/facebook.png',
                'alt': 'link a Facebook'
              },
              {
                'name': 'web',
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
    }
  },

  watch: {
    /**
     * Updates data if the url param changes
     */
    '$route.params.professional_id': function () {
      this.loadUserProfile();
    },
  }
}
</script>
