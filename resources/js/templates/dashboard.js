import "../bootstrap";
import { createApp } from "vue";
import dash from "./dashboard.vue";
import vuetify from "../vuetify";
createApp(dash).use(vuetify).mount("#dashboard");