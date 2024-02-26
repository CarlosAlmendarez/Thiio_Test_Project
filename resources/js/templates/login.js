import "../bootstrap";
import { createApp } from "vue";
import login from "./login.vue";
import vuetify from "../vuetify";
createApp(login).use(vuetify).mount("#login");