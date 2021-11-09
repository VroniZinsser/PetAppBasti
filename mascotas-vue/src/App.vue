<template>
  <v-app>
    <v-app-bar
        app
    >
      <div id="skip-to-content">
        <a href="#main-content">Saltar al contenido principal</a>
      </div>
    </v-app-bar>

    <v-main id="main-content">
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  data: () => ({
  }),
};
</script>
