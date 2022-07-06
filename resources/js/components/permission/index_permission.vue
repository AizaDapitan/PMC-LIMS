<template>
  <div class="container pd-x-0">
    <div
      class="
        d-sm-flex
        align-items-center
        justify-content-between
        mg-b-20 mg-lg-b-25 mg-xl-b-30
      "
    >
      <div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-style1 mg-b-5">
            <li class="breadcrumb-item active" aria-current="page">
              Permissions
            </li>
          </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Manage Permissions</h4>
      </div>
    </div>

    <div class="row row-sm">
      <!-- Start Pages -->

      <div class="col-md-12">
        <Toolbar class="mb-4">
          <template #start>
            <Button
              label="Export"
              icon="pi pi-upload"
              class="p-button-help p-button-sm mr-2"
              @click="exportCSV($event)"
            />
            <Button
              label="New"
              icon="pi pi-plus"
              class="p-button-success p-button-sm mr-2"
              @click="addNew()"
            />
          </template>
          <template #end>
            <div class="search-form mg-r-10">
              <input
                name="search"
                type="search"
                id="search"
                class="form-control"
                placeholder="Search"
                v-model="filters['global'].value"
              />
              <button class="btn filter" id="btnSearch">
                <i data-feather="search"></i>
              </button>
            </div>
          </template>
        </Toolbar>
        <div class="table-list mg-b-10">
         
        </div>
      </div>
      <!-- End Pages -->
    </div>
  </div>

  <toast
    :breakpoints="{ '920px': { width: '100%', right: '0', left: '0' } }"
  ></toast>
</template>
<script>
import { FilterMatchMode, FilterOperator } from "primevue/api";
export default {
  props: ["permissions"],
  data() {
    return {
      dashboard: this.$env_Url + "/dashboard",
      filters: null,
      editMsg: "Edit Permission",
    };
  },
  created() {
    this.initFilters();
  },
  methods: {
    initFilters() {
      this.filters = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
      };
    },
    clearFilter() {
      this.filters["global"].value = null;
    },
    addNew() {
      window.location.href = this.$env_Url + "/permissions/create";
    },

    editPermission(data) {
      let src = data.data.id,
        alt = data.data.id;
      window.location.href = this.$env_Url + "/permissions/edit/" + alt;
    },

    exportCSV() {
      this.$refs.dt.exportCSV();
    },
  },
};
</script>