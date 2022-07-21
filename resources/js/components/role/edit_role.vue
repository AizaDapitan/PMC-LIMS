
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
              Edit Role
            </li>
          </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Edit Role</h4>
      </div>
    </div>

    <div class="row row-sm">
      <div class="col-lg-6">
        <input type="hidden" v-model="form.id" />

        <div class="form-group">
          <label class="d-block">Status *</label>
          <input type="checkbox" id="isActive" :checked="form.checked == 1" />
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
            placeholder="Role Name"
            v-model="form.name"
          />
        </div>

        <div class="form-group">
          <label class="d-block">Role Description *</label>
          <input
            type="text"
            class="form-control"
            v-model="form.description"
            placeholder="Role Description"
          />
        </div>
      </div>

      <div class="col-lg-12 mg-t-30">
        <button class="btn btn-primary btn-sm" @click.prevent="updateRole">
          Update
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
const env_Url = process.env.MIX_APP_URL;

export default {
  props: ["role"],
  data() {
    return {
      errors: [],
      success: "",
      roles: env_Url + "/roles/list",
      dashboard: env_Url + "/dashboard",
      form: {
        id: this.role.id,
        name: this.role.name,
        description: this.role.description,
        active: true,
        checked: this.role.active,
      },
    };
  },

  methods: {
    async updateRole() {
      this.form.active = document.getElementById("isActive").checked;
      // console.log(this.form.active);
      const res = await this.submit("post", "/roles/update", this.form, {
        headers: {
          "Content-Type":
            "multipart/form-data; charset=utf-8; boundary=" +
            Math.random().toString().substr(2),
        },
      });
      if (res.status === 200) {
        this.updmessage();
      } else if (res.status == 500) {
        this.singleermessage(res.data.error);
      } else {
        this.errors = res.data.errors;
      }
    },
  },
};
</script>
