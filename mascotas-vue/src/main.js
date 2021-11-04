import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import DatetimePicker from 'vuetify-datetime-picker'

Vue.config.productionTip = false
Vue.use(DatetimePicker);

new Vue({
  router,
  vuetify,
  render: function (h) { return h(App) }
}).$mount('#app')
