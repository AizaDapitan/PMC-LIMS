
<template>
  <div class="container-fluid pd-x-0">
    <div
      class="
        d-sm-flex
        align-items-center
        justify-content-between
        mg-b-20 mg-lg-b-25 mg-xl-b-30
      "
    >
      <div>
        <div v-if="errors">
          <p v-for="error in errors" :key="error" class="alert alert-danger">
            {{ error }}
          </p>
        </div>
        <p v-if="success != ''" class="alert alert-success">
          {{ success }}
        </p>

        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-style1 mg-b-5">
            <li class="breadcrumb-item" aria-current="page">
              <a :href="permissions">Permissions</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Add New Permission
            </li>
          </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Add New Permission</h4>
      </div>
    </div>

    <div class="row row-sm">
      <div class="col-lg-6">
        <div class="form-group">
          <label class="d-block">Status *</label>
          <input
            type="checkbox"
            id="statusValue"
            @click="storeValue(statusValue)"
            checked
          />
          <span>&nbsp;</span>
          <label for="statusValue">
            <span>Active</span>
          </label>
        </div>

        <div class="form-group">
          <label class="d-block">Module *</label>
          <select class="custom-select" @change="getData($event)">
            <option selected>Select Module</option>
            <option
              v-for="module in modules"
              :key="module.description"
              :value="module.description"
            >
              {{ module.description }}
            </option>
          </select>
        </div>

        <div class="form-group">
          <label class="d-block">Permission Description *</label>
          <textarea
            class="form-control"
            rows="3"
            v-model="form.description"
            placeholder="Permission Description"
            maxlength="190"
          ></textarea>
        </div>
      </div>

      <div class="col-lg-12 mg-t-30">
        <button
          class="btn btn-primary btn-sm"
          @click.prevent="createPermission"
        >
          Submit
        </button>
        &nbsp;
        <a
          :href="permissions"
          class="btn btn-outline-secondary btn-sm"
          type="cancel"
          >Cancel</a
        >
      </div>
    </div>
  </div>
  <toast
    :breakpoints="{ '920px': { width: '100%', right: '0', left: '0' } }"
  ></toast>
</template>

<script  type="application/javascript">
export default {
  data() {
    return {
      errors: [],
      success: "",
      permissions: this.$env_Url + "/permissions/list",
      dashboard: this.$env_Url + "/dashboard",

      form: {
        description: "",
        status: false,
      },
      modules: [],
    };
  },

  mounted() {
    this.fetchModules();
  },

  methods: {
    getData(event) {
      this.form.module_type = event.target.value;
    },

    async createPermission() {
      const res = await this.submit("post", "/permissions/store", this.form, {
        headers: {
          "Content-Type":
            "multipart/form-data; charset=utf-8; boundary=" +
            Math.random().toString().substr(2),
        },
      });
      if (res.status === 200) {
        this.smessage();
        this.form.description = "";
        this.form.status = false;
      } else if (res.status == 500) {
        this.singleermessage(res.data.error);
      } else {
        this.errors = res.data.errors;
      }
    },

    async fetchModules() {
      const res = await this.callApi("get", "/permissions/modulesList");
      this.modules = res.data;
    },

    storeValue(statusValue) {
      if (document.getElementById("statusValue").checked) {
        this.form.status = 1;
      } else {
        this.form.status = 0;
      }
    },
  },
};
</script>
