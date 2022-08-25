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
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item" aria-current="page">LIMS</li>
            <li class="breadcrumb-item" aria-current="page">Assayer</li>
            <li class="breadcrumb-item active" aria-current="page">
              Dashboard
            </li>
          </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Home/Dashboard - Assayer</h4>
      </div>
    </div>
    <div v-if="errors_exist" class="alert alert-danger" role="alert">
      Whoops! Something didn't work.
      <ul>
        <div v-for="error in errors" :key="error.id">
          <li>{{ error[0] }}</li>
        </div>
      </ul>
    </div>
    <div class="row row-sm">
      <!-- Start Pages -->

      <div class="col-md-12">
        <Toolbar class="mb-4 table-light">
          <template #start>
            <Button
              label="Export"
              icon="pi pi-upload"
              class="p-button-help p-button-sm mr-2"
              @click="exportCSV($event)"
            />
          </template>
          <template #end>
            <div class="col-lg-6">
              <select
                class="custom-select tx-base"
                id="type"
                name="type"
                v-model="filters['transType'].value"
              >
                <option value="" selected>Select Transmittal Type</option>
                <option value="Rock">Rock</option>
                <option value="Carbon">Carbon</option>
                <option value="Solid">Solid</option>
                <option value="Bulk">Bulk</option>
                <option value="Cut">Cut</option>
                <option value="Mine Drill">Mine Drill</option>
              </select>
            </div>
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
          <div class="table-responsive-lg">
            <DataTable
              ref="dt"
              :value="transmittals"
              :paginator="true"
              :rows="10"
              stripedRows
              removableSort
              paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
              :rowsPerPageOptions="[10, 20, 50]"
              responsiveLayout="scroll"
              :loading="loading1"
              currentPageReportTemplate="Showing {first} to {last} of {totalRecords}"
              v-model:filters="filters"
              filterDisplay="menu"
              :globalFilterFields="[
                'transmittalno',
                'date_time_submitted',
                'email_address',
                'purpose',
                'date_needed',
                'priority_status',
                'source',
                'statuses',
              ]"
              v-model:selection="selectedTrans"
              :selectAll="selectAll"
              @select-all-change="onSelectAllChange"
              @row-select="onRowSelect"
              @row-unselect="onRowUnselect"
            >
              <template #empty> No record found. </template>
              <template #loading> Loading data. Please wait. </template>
              <Column field="id" hidden="true"></Column>
              <Column>
                <template #header>
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      @change="checkAll($event)"
                      class="custom-control-input"
                      id="checkboxall"
                    /><label
                      class="custom-control-label"
                      for="checkboxall"
                    ></label>
                  </div>
                </template>
                <template #body="slotProps">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      class="custom-control-input cb"
                      @change="checked(slotProps, $event)"
                      name="chkboxes"
                      style="opacity: 1"
                      :id="slotProps.data.transmittalno"
                      :disabled="!slotProps.data.isupdated"
                    />
                    <label
                      class="custom-control-label"
                      :for="slotProps.data.transmittalno"
                    ></label>
                  </div>
                </template>
              </Column>
              <Column
                field="transmittalno"
                header="Transmittal No"
                :sortable="true"
              ></Column>
              <Column
                field="transType"
                header="Transmittal Type"
                :sortable="true"
              ></Column>
              <Column
                field="datesubmitted"
                header="Date Submitted"
                :sortable="true"
              ></Column>
              <Column
                field="timesubmitted"
                header="Time Submitted"
                :sortable="true"
              >
                <template #body="slotProps">
                  <span>{{
                    slotProps.data.timesubmitted.replace(":00.0000000", "")
                  }}</span>
                </template></Column
              >
              <Column
                field="email_address"
                header="Email Address"
                :sortable="true"
              ></Column>
              <Column
                field="purpose"
                header="Purpose"
                :sortable="true"
              ></Column>
              <Column
                field="date_needed"
                header="Date Needed"
                :sortable="true"
              ></Column>

              <Column
                field="priority"
                header="Priority"
                :sortable="true"
                :exportable="false"
              >
                <template #body="slotProps">
                  <span
                    v-if="slotProps.data.priority == 'High'"
                    class="badge badge-danger tx-uppercase"
                    >High</span
                  >
                  <span
                    v-if="slotProps.data.priority == 'Medium'"
                    class="badge badge-warning tx-uppercase"
                    >Medium</span
                  >
                  <span
                    v-if="slotProps.data.priority == 'Low'"
                    class="badge badge-success tx-uppercase"
                    >Low</span
                  >
                </template>
              </Column>

              <Column field="source" header="Source" :sortable="true"></Column>
              <Column field="status" header="Status" :sortable="true">
                <template #body="slotProps">
                  <span
                    v-if="slotProps.data.isReceived == 1"
                    class="badge badge-danger tx-uppercase"
                    >Received</span
                  >
                  <span
                    v-else-if="slotProps.data.status == 'Approved'"
                    class="badge badge-success tx-uppercase"
                    >Approved</span
                  >
                  <span v-else>Pending</span>
                </template>
              </Column>

              <Column
                :exportable="false"
                style="min-width: 13rem"
                header="Actions"
              >
                <template #body="slotProps">
                  <Button
                    v-bind:title="viewMsg"
                    icon="pi pi-eye"
                    class="p-button-rounded p-button-success mr-2"
                    @click="viewTransmittal(slotProps)"
                  />
                </template>
              </Column>
            </DataTable>
          </div>
        </div>
        <div class="row mg-t-25">
          <div class="col-lg-12">
            <div class="d-lg-flex justify-content-lg-end">
              <button
                class="
                  btn btn-primary
                  tx-13
                  btn-uppercase
                  mr-2
                  mb-2
                  ml-lg-1
                  mr-lg-0
                "
                :disabled="!selectedTrans || !selectedTrans.length"
                @click="createWorksheet"
              >
                <i data-feather="file-plus" class="mg-r-5"></i> Create Worksheet
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- End Pages -->
    </div>
    <div class="cms-footer mg-t-50">
      <hr />
      <p class="tx-gray-500 tx-10">
        Admin Portal v1.0 • Developed by WebFocus Solutions, Inc. 2022
      </p>
    </div>
  </div>

  <toast
    :breakpoints="{ '920px': { width: '100%', right: '0', left: '0' } }"
  ></toast>
  <ConfirmDialog></ConfirmDialog>
</template>
<script>
import { FilterMatchMode, FilterOperator } from "primevue/api";
export default {
  data() {
    return {
      transmittals: [],
      dashboard: this.$env_Url + "/assayer/dashboard",
      create: this.$env_Url + "/assayer/create-worksheet",
      filters: null,
      viewMsg: "View Transmittal",
      editMsg: "Edit Transmittal",
      receiveMsg: "Receive Transmittal",
      statuses: ["Pending", "Approved", "Received"],
      selectedTrans: [],
      selectAll: false,
      totalRecords: 0,
      transIds: null,
      errors: {},
      errors_exist: false,
    };
  },
  created() {
    this.fetchRecord();
    this.initFilters();
  },
  methods: {
    async fetchRecord() {
      const res = await this.callApiwParam(
        "post",
        "/assayer/getTransmittal",
        this.form
      );
      this.transmittals = res.data;
    },
    initFilters() {
      this.filters = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        transType: { value: "", matchMode: FilterMatchMode.EQUALS },
      };
    },
    clearFilter() {
      this.filters["global"].value = null;
    },

    viewTransmittal(data) {
      let src = data.data.id,
        alt = data.data.id;
      window.location.href = this.$env_Url + "/assayer/view-transmittal/" + alt;
    },
    exportCSV() {
      this.$refs.dt.exportCSV();
    },

    checked(transmittal, event) {
      if (event.target.checked) {
        this.selectedTrans.push(transmittal.data);
      } else {
        _.remove(this.selectedTrans, function (val) {
          return val === transmittal.data;
        });
      }
    },
    checkAll(event) {
      var checkboxes = document.getElementsByName("chkboxes");
      this.selectedTrans = [];
      this.errors_exist = false;
      this.errors = {};
      if (this.filters["transType"].value == "") {
        this.errors = {
          error: ["Must select Transmittal Type first!"],
        };
        this.errors_exist = true;
      }
      for (var transmittal of this.transmittals) {
        if (
          transmittal["isupdated"] &&
          transmittal["transType"] == this.filters["transType"].value
        ) {
          document.getElementById(transmittal["transmittalno"]).checked =
            event.target.checked;

          if (event.target.checked) {
            this.selectedTrans.push(transmittal);
          }
        }
      }
      console.log(this.selectedTrans);
    },
    createWorksheet() {
      if (this.selectedTrans) {
        var ids = "";
        this.selectedTrans.forEach(function (element, index) {
          if (index == 0) {
            ids = element.transmittalno;
          } else {
            ids = ids + "," + element.transmittalno;
          }
        });
        this.transIds = ids;
      }
      window.location.href =
        this.$env_Url + "/assayer/create-worksheet/" + this.transIds;
    },
  },
};
</script>