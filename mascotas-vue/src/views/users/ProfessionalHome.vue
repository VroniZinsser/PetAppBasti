<template>
  <Loader v-if="loading"></Loader>

  <div v-else class="professional-home">
    <TitleBar :title="`Buenos días ${store.user.first_name} ${store.user.last_name}`"></TitleBar>
    <BaseNotification
      v-if="store.status.msg != null"
      :type="store.status.type"
      :text="store.status.msg"
      :title="store.status.title"
    />
    <div class="home-container">
      <ProfileCard 
        :user="me"
      />
      <h2>Mascotas compartidas con vos</h2>
      <p v-if="sharedPets.length === 0">Actualmente no hay mascotas compartidas.</p>
    </div>
  </div>
    
</template>

<script>
import TitleBar from "@/components/general/layouts/TitleBar";
import Loader from "@/components/general/notifications/Loader";
import ProfileCard from "@/components/users/professionals/ProfileCard";
import BaseNotification from "@/components/general/notifications/BaseNotification";
import store from "@/store";
import contactService from "@/services/contact";
import authService from "@/services/auth";

export default {
  name: "ProfessionalHome",

  components: {
    TitleBar,
    Loader,
    BaseNotification,
    ProfileCard,
  },

   data() {
    return {
      loading: true,
      store,
      sharedPets: [],
      authenticatedUser: [],
      me: null,
    }
  },

  mounted() {
    this.loading = true;
    authService.me()
      .then(res => {
        this.me = res.data.user;
        contactService.getProfessionalSharedPets()
        .then(res => {
            this.sharedPets = res.data.sharedPets;
            this.loading = false;
        })
      })
  }
}

</script>