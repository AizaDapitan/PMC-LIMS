
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
              Edit Permission
            </li>
          </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Edit Permission</h4>
      </div>
    </div>

    <div class="row row-sm">
      <div class="col-lg-6">
        <input type="hidden" v-model="form.id">

        <div class="form-group">
          <label class="d-block">Status *</label>
          <input
            type="checkbox"
            id="isActive"
            :checked="form.checked == 1"
          />
           <span>&nbsp;</span>
          <label for="statusValue">
            <span>Active</span>
          </label>
        </div>

        <div class="form-group">
          <label class="d-block">Module *</label>
            
            <select class="custom-select" v-model="selectedValue" @change="getData($event)">
              <option selected>Select Module</option>
              <option v-for="module in modules" 
                :key="module.description"                
                :value="module.description" >{{ module.description }}</option>
            </select>

        </div>
        
        <div class="form-group">
          <label class="d-block">Permission Description *</label>
          <input
            type="text"
            class="form-control"
            v-model="form.description"
            placeholder="Permission Description"
          />
        </div>

      </div>

      <div class="col-lg-12 mg-t-30">
        <button
          class="btn btn-primary btn-sm"
          @click.prevent="updatePermission"
        >
          Update
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
  props: ["permission"],
  data() {
    return {
      errors: [],
      success: "",
      permissions: this.$env_Url + "/permissions/list",
      dashboard: this.$env_Url + "/dashboard",

      selectedValue: "",
      modules: [],

      form: {
        id: this.permission.id,
        module_type: this.permission.module_type,
        description: this.permission.description,        
        active: true,
        checked: this.permission.active,        
      },
            
    };
  },

  mounted() {    
				
        this.fetchModules();
        this.selectedValue = this.permission.module_type
  },    

  methods: {

    getData(event){
      console.log(event.target.value);
      this.form.module_type = event.target.value
    },

    async updatePermission() {
      this.form.active = document.getElementById('isActive').checked;
      // console.log(this.form.active);
      const res = await this.submit(
        "post",
        "/permissions/update",
        this.form,
        {
          headers: {
            "Content-Type":
              "multipart/form-data; charset=utf-8; boundary=" +
              Math.random().toString().substr(2),
          },
        }
      );
      if (res.status === 200) {
        this.updmessage();
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

  },
};
</script>
