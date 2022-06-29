require('./bootstrap');

window.Vue = require("vue").default;
import { createApp } from "vue";
const app = createApp({});

app.config.globalProperties.$env_Url = process.env.MIX_APP_URL;

app.component(
    "login-component",
    require("./components/auth/login.vue").default
);
app.component(
    "deptuser-dashboard",
    require("./components/deptuser/dashboard.vue").default
);

app.mount("#app");
