<template>
  <v-app>
    <div id="skip-to-content">
      <a href="#main-content">Saltar al contenido principal</a>
    </div>

    <v-app-bar app>
      <div id="brand-image">
        <router-link :to="{name: 'Home'}">
          <img :src="createStaticImgPath('brand/logotype.png')" alt="Logo de Basti">
        </router-link>
      </div>

      <v-spacer></v-spacer>

      <ul id="nav-links">
        <li v-for="link in routerLinksProfessional" :key="link.text">
          <router-link :to="{name: link.name}" exact>
            <span class="material-icons">{{ link.icon }}</span>
            <span>{{ link.text }}</span>
          </router-link>
        </li>
        <li v-if="store.user.id">
          <a href="#" @click.prevent="showSettingsDialog = true">
            <span class="material-icons">account_circle</span>
            <span class="sr-only">Abrir opciones (abre ventana modal)</span>
          </a>
        </li>
        <li v-else>
          <router-link :to="{name: 'Login'}" exact>
            <span class="material-icons">login</span>
            <span>Ingresar</span>
          </router-link>
        </li>

      </ul>
    </v-app-bar>

    <SettingsDialog 
      :showDialog="showSettingsDialog"
      :user="store.user"
      @cancle="showSettingsDialog = false"
      @logout="logout"
      @delete-account="showDeleteAccountDialog"
    />

    <WarnDialog
      :showDialog="showWarnDialog" 
      dialogTitle="¿Eliminar tu cuenta de usuario?"
      dialogText="¿Estás seguro que ya no querés ser parte de Basti? Si eliminás tu cuenta, tu perfil ya no estará disponible y no aparecerá en el mapa. No tendrás más acceso a las mascotas compartidas con vos."
      acceptButtonText="Sí, eliminar mi cuenta"

      @cancle="showWarnDialog = false"
      @accept="deleteAccount"
    />

    <!--Config modal-->
    <v-dialog v-model="dialog" max-width="500" class="container--fluid">
      <v-card id="config-list">
        <ul>
          <li><a href="#">Configuración</a></li>
          <li><a class="danger-text" @click.prevent="logout">Cerrar sesión</a></li>
          <li>
            <v-btn @click="dialog=false">Cancelar</v-btn>
          </li>
        </ul>
      </v-card>
    </v-dialog>

    <v-main id="main-content" class="pt-0">
      <router-view @create-notification="createNotification"/>
    </v-main>
  </v-app>
</template>

<script>

import {createStaticImgPath} from "@/helpers";
import authService from "./services/auth";
import SettingsDialog from "@/components/users/settings/SettingsDialog";
import WarnDialog from "@/components/general/notifications/WarnDialog";
import store from "./store";
import userService from "@/services/users";


export default {
  name: 'App',

  components: {
    SettingsDialog,
    WarnDialog,
  },

  data: () => ({
    dialog: false,
    showSettingsDialog: false,
    showWarnDialog: false,
    createStaticImgPath,
    store,
    routerLinks: [
      {
        name: 'Schedule',
        text: 'Agenda',
        icon: 'event',
      },
      {
        name: 'Explore',
        text: 'Explorar',
        icon: 'search',
      },
      {
        name: 'Pets',
        text: 'Mascotas',
        icon: 'format_list_bulleted',
      },
      {
        name: 'SharedPets',
        text: 'Compartir',
        icon: 'share',
      },
    ],
    routerLinksProfessional: [
      {
        name: 'HomeProfessional',
        text: 'Home',
        icon: 'home',
      },
      {
        name: 'ScheduleProfessional',
        text: 'Agenda',
        icon: 'event',
      },
      {
        name: 'ExploreProfessional',
        text: 'Explorar',
        icon: 'search',
      },
    ]
  }),
  methods: {
    /**
     * Logs out the user, and redirects to the login view
     */
    logout() {
      this.showSettingsDialog = false;
      this.store.setActivePet(null);
      this.store.setStatus({
        msg: 'Gracias y hasta la próxima',
        type: 'success',
      });
      authService.logout()
          .then(() => {
            this.dialog = false;
            this.$router.push({name: 'Login'});
          });
    },

    createNotification(type, content) {
      this.store.setStatus({
        msg: content,
        type: type,
      });
    },

    showDeleteAccountDialog() {
      this.showSettingsDialog = false;
      this.showWarnDialog = true;
    },

    deleteAccount() {
      this.showWarnDialog = false;
      this.$router.push({name: 'Login'});
      userService.delete(this.store.user.id)
        .then(res => {
          if (res.success) {
            this.$router.push({name: 'Login'});
          } else {
            this.store.setStatus({
              msg: 'Algo salió mal. Intentalo nuevamente más tarde.',
              type: 'error',
            });
          }
        })
    }
  },
};
</script>
