
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
              <a :href="roles">Roles</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Add New Role
            </li>
          </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Add New Role</h4>
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
          <span> &nbsp;</span>
          <label for="statusValue">
            <span>Active</span>
          </label>
        </div>

        <div class="form-group">
          <label class="d-block">Role Name *</label>
          <input
            type="text"
            class="form-control"
            v-model="form.name"
            placeholder="Role Name"
            maxlength="150"
          />
        </div>

        <div class="form-group">
          <label class="d-block">Role Description *</label>
          <textarea
            class="form-control"
            rows="3"
            v-model="form.description"
            placeholder="Role Description"
            maxlength="190"
          ></textarea>
        </div>
      </div>

      <div class="col-lg-12 mg-t-30">
        <button class="btn btn-primary btn-sm" @click.prevent="createRole">
          Submit
        </button>
        &nbsp;
        <a :href="roles" class="btn btn-outline-secondary btn-sm" type="cancel"
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
      roles: this.$env_Url + "/roles/list",
      dashboard: this.$env_Url + "/dashboard",

      form: {
        name: "",
        description: "",
        status: false,
      },
    };
  },

  methods: {
    async createRole() {
      const res = await this.submit("post", "/roles/store", this.form, {
        headers: {
          "Content-Type":
            "multipart/form-data; charset=utf-8; boundary=" +
            Math.random().toString().substr(2),
        },
      });
      if (res.status === 200) {
        this.smessage();
        this.form.name = "";
        this.form.description = "";
        this.form.status = false;
      } else if (res.status == 500) {
        this.singleermessage(res.data.error);
      } else {
        this.errors = res.data.errors;
      }
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
