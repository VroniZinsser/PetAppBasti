import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';

Vue.use(Vuetify);

export default new Vuetify({
    /* Override default vuetify breakpoints */
    /* md is 992px + 16px scrollbar width*/
    breakpoint: {
        thresholds: {
            sm: 768,
            md: 1008,
        },
    },
});
