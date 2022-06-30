require('./bootstrap');

window.Vue = require("vue").default;
import { createApp } from "vue";
import common from "./common";
import PrimeVue from "primevue/config";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import Toolbar from "primevue/toolbar";
import Toast from "primevue/toast";
import ToastService from "primevue/toastservice";

import "primevue/resources/themes/saga-blue/theme.css";
import "primevue/resources/primevue.min.css";

const app = createApp({});
app.mixin(common);
app.use(PrimeVue);
app.use(ToastService);

app.config.globalProperties.$env_Url = process.env.MIX_APP_URL;

app.component(
    "login-component",
    require("./components/auth/login.vue").default
);
app.component(
    "deptuser-dashboard",
    require("./components/deptuser/dashboard.vue").default
);
app.component(
    "create_role-component",
    require("./components/role/create_role.vue").default
);
app.component(
    "index_role-component",
    require("./components/role/index_role.vue").default
);
app.component(
    "edit_role-component",
    require("./components/role/edit_role.vue").default
);

app.component(
    "create_permission-component",
    require("./components/permission/create_permission.vue").default
);
app.component(
    "index_permission-component",
    require("./components/permission/index_permission.vue").default
);
app.component(
    "edit_permission-component",
    require("./components/permission/edit_permission.vue").default
);
app.component("DataTable", DataTable);
app.component("Column", Column);
app.component("Toolbar", Toolbar);
app.component("Button", Button);
app.component("Toast", Toast);

app.mount("#app");
