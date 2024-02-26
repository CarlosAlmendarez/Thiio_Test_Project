import "../bootstrap";
import { createApp } from "vue";
import signup from "./signup.vue";
import vuetify from "../vuetify";
createApp(signup).use(vuetify).mount("#signup");