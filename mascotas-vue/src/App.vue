<template>
  <v-app>
    <div id="skip-to-content">
      <a href="#main-content">Saltar al contenido principal</a>
    </div>

    <v-app-bar app>
      <div id="brand-image">
        <router-link :to="{name: 'Home'}">
          <img :src="getCompletePath('brand/logotype.png')" alt="Logo de Basti">
        </router-link>
      </div>

      <v-spacer></v-spacer>

      <ul id="nav-links">
        <li v-for="link in routerLinks" :key="link.text">
          <router-link :to="{name: link.name}" exact>
            <span class="material-icons">{{ link.icon }}</span>
            <span>{{ link.text }}</span>
          </router-link>
        </li>
        <li v-if="store.user.id">
          <a href="#" @click.prevent="dialog = true">
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
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>

import {PATH_IMG} from "./constants";
import authService from "./services/auth";
import store from "./store";

export default {
  name: 'App',

  data: () => ({
    dialog: false,
    store,
    routerLinks: [
      {
        name: 'Home',
        text: 'Agenda',
        icon: 'event',
      },
      {
        name: 'ShowMap',
        text: 'Explorar',
        icon: 'search',
      },
      {
        name: 'PetShowList',
        text: 'Mascotas',
        icon: 'format_list_bulleted',
      },
      {
        name: 'Home',
        text: 'Conversaciones',
        icon: 'chat_bubble',
      },
    ]
  }),
  methods: {
    /**
     * Returns the path to the image folder concatenated with the path passed by parameter
     *
     * @param {string} path
     * @returns {string}
     */
    getCompletePath(path) {
      return PATH_IMG + path
    },

    /**
     * Logs out the user, and redirects to the login view
     */
    logout() {
      authService.logout()
          .then(() => {
            this.dialog = false;
            this.$router.push({name: 'Login'});
          });
    },
  },
};
</script>
