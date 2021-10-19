import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import VueGeolocation from 'vue-browser-geolocation'
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.config.productionTip = false
Vue.use(VueGeolocation)

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyAx0l4CqJy3P2widDbKV-TyR3QM0ySLCDc'
  },
  installComponents: true,
})

new Vue({
  router,
  vuetify,
  render: function (h) { return h(App) }
}).$mount('#app')
