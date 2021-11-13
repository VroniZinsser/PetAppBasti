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
          <router-link :to="{name: link.name}">
            <span class="material-icons">{{ link.icon }}</span>
            <span>{{ link.text }}</span>
          </router-link>
        </li>
        <li>
          <a href="#" @click.prevent="dialog = true">
            <span class="material-icons">account_circle</span>
            <span class="sr-only">Abrir opciones (abre ventana modal)</span>
          </a>
        </li>
      </ul>
    </v-app-bar>

    <!--Config modal-->
    <v-dialog v-model="dialog" max-width="500" class="container--fluid">
      <v-card id="config-list">
        <ul>
          <li><a href="#">Configuración</a></li>
          <li><a href="#" class="danger-text">Cerrar sesión</a></li>
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

export default {
  name: 'App',

  data: () => ({
    dialog: false,
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
    getCompletePath(path) {
      return PATH_IMG + path
    }
  }
};
</script>
