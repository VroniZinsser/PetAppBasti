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
      <div class="owner-share-list" v-if="sharedPets.length > 0">
        <h2>Mascotas compartidas con vos</h2>

        <List :shared-pets="sharedPets" @delete-request="deleteRequest"/>

      </div>
      <p v-if="sharedPets.length === 0">Actualmente no hay mascotas compartidas.</p>
    </div>
  </div>

</template>

<script>
import TitleBar from "@/components/general/layout/TitleBar";
import Loader from "@/components/general/layout/TheLoader";
import ProfileCard from "@/components/user/professional/ProfessionalProfileCard";
import BaseNotification from "@/components/general/notification/BaseNotification";
import store from "@/store";
import contactService from "@/services/contact";
import authService from "@/services/auth";
import { handleAccessError } from "@/helpers";
import List from "@/components/contact/list/ProfessionalShareList";

export default {
  name: "ProfessionalHome",

  components: {
    List,
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
      handleAccessError,
    }
  },
  methods: {
    deleteRequest(id) {
      contactService.delete(id)
          .then(res => {
            if(res.success){
              this.sharedPets = this.sharedPets.filter(request => request.id !== id);
              this.store.setStatus({
                msg: 'La mascota se quitó de la lista con éxito',
                type: 'success',
              })
            }

          });
    }
  },
  mounted() {
    this.loading = true;
    authService.me()
        .then(res => {
          this.me = res.data.user;
          contactService.getProfessionalSharedPets()
              .then(res => {
                if (this.handleAccessError(res)) return;
                this.sharedPets = res.data.sharedPets;
                this.loading = false;
              })
        })
  }
}

</script>