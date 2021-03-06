
require('./bootstrap');

window.Vue = require('vue');
import Index from "./components/Index";
import router from "./router/router";
import vuetify from "./plugins/vuetify";
import store from './store/index'
import ValidationErrors from "./shared/components/ValidationErrors";
import VueSimplemde from "vue-simplemde";
//import moment from "moment/moment";
import marked from 'marked';
window.marked = marked;

Vue.component('vue-simplemde', VueSimplemde);

Vue.component('validation-errors', ValidationErrors);

window.axios.interceptors.response.use(
    response => response,
    error => {
        if(error.response.status === 401){
            store.dispatch('logout')
        }
        return Promise.reject(error);
    }
);

const app = new Vue({
    el: '#app',
    router,
    vuetify,
    store,
   // moment,
    components:{
        'index': Index
    },
    async beforeCreate() {
        this.$store.dispatch('loadUser');
        this.$store.dispatch('loadCategories')
    }
});
