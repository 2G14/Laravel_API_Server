import "./bootstrap.js";
import Vue from "vue";
import store from "./plugins/store.js";
import router from "./plugins/router.js";
import vuetify from "./plugins/vuetify.js";
import App from "./components/App.vue";

const app = new Vue({
  el: "#app",
  store,
  router,
  vuetify,
  render: h => h(App)
});
