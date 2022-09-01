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
            <li class="breadcrumb-item" aria-current="page">
              <a :href="dashboard">LIMS</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              <a :href="dashboard">Receiving</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Edit Transmittal - Receiving</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="d-lg-flex justify-content-lg-end">
          <div
            class="
              form-group
              d-flex
              flex-column flex-lg-row
              align-items-lg-center
            "
          >
            <label for="customFile" class="mg-r-10">Attached COC</label>
            <div class="custom-file mb-0 mb-lg-2">
              <input
                type="text"
                class="form-control"
                id="transmittal-no"
                name="transmittal-no"
                v-model="this.cocFileLabel"
                disabled="true"
              />
            </div>
            <a
              :href="this.cocPath"
              target="_blank"
              class="
                btn btn-primary
                tx-13
                btn-uppercase
                mr-2
                mb-2
                ml-lg-1
                mr-lg-0
              "
            >
              <i data-feather="zoom-in" class="mg-r-5"></i> View
            </a>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="form-group">
          <label for="transmittal-no">Transmittal No.</label>
          <input
            type="text"
            class="form-control"
            id="transmittal-no"
            name="transmittal-no"
            v-model="form.transmittalno"
            disabled="true"
          />
        </div>

        <div class="row row-sm">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="date-submitted">Date Submitted</label>
              <input
                type="text"
                class="form-control"
                id="date-submitted"
                name="date-submitted"
                pattern="\d{2}\/\d{2}\/\d{4}"
                placeholder="mm/dd/yyyy"
                disabled="true"
              />
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label for="time-submitted">Time Submitted</label>
              <input
                type="time"
                class="form-control"
                id="time-submitted"
                name="time-submitted"
                disabled="true"
                v-model="form.timesubmitted"
              />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="email-address">Email Address</label>
          <input
            type="email"
            class="form-control"
            id="email-address"
            name="email-address"
            disabled="true"
            v-model="form.email_address"
          />
        </div>
      </div>

      <div class="col-lg-6">
        <div class="row row-sm">
          <div class="col-lg-8">
            <div class="form-group">
              <label for="purpose"
                >Purpose<span class="text-danger" aria-required="true">
                  *
                </span></label
              >
              <input
                type="text"
                class="form-control"
                id="purpose"
                name="purpose"
                disabled="true"
                v-model="form.purpose"
              />
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="type"
                >Type<span class="text-danger" aria-required="true">
                  *
                </span></label
              >
              <select
                class="custom-select tx-base"
                id="type"
                name="type"
                disabled="true"
                v-model="form.transType"
              >
                <option value="Rock">Rock</option>
                <option value="Carbon">Carbon</option>
                <option value="Solid">Solid</option>
                <option value="Bulk">Bulk</option>
                <option value="Cut">Cut</option>
                <option value="Mine Drill">Mine Drill</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row row-sm">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="date-needed">Date Needed</label>
              <input
                type="text"
                class="form-control"
                id="date-needed"
                name="date-needed"
                pattern="\d{2}\/\d{2}\/\d{4}"
                placeholder="mm/dd/yyyy"
                disabled="true"
              />
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label for="priority">Priority</label>
              <select
                class="custom-select tx-base"
                id="priority"
                v-model="form.priority"
                name="priority"
                disabled="true"
              >
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
              </select>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label for="status">Status</label>
              <select
                class="custom-select tx-base"
                id="status"
                name="status"
                disabled="true"
                v-model="form.status"
              >
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="source">Source</label>
          <input
            type="text"
            class="form-control"
            id="source"
            name="source"
            disabled="true"
            v-model="form.source"
          />
        </div>
      </div>

      <div class="col-lg-12">
        <hr class="mg-t-10 mg-b-30" />
      </div>
    </div>

    <div class="row row-xs">
      <div class="col-lg-12">
        <div class="table-responsive-lg">
          <DataTable
            ref="dt"
            :value="items"
            :paginator="true"
            :rows="10"
            stripedRows
            paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
            :rowsPerPageOptions="[10, 20, 50]"
            responsiveLayout="scroll"
            :loading="loading"
            currentPageReportTemplate="Showing {first} to {last} of {totalRecords}"
            v-model:filters="filters"
            filterDisplay="menu"
            rowIndexVar
          >
            <template #empty> No record found. </template>
            <template #loading> Loading data. Please wait. </template>

            <Column header="Item No.">
              <template #body="slotProps">
                {{ slotProps.index + 1 }}
              </template></Column
            >
            <Column field="id" hidden="true"></Column>
            <Column field="sampleno" header="Sample No."></Column>
            <Column field="samplewtvolume" header="Sample Wt./Volume"></Column>
            <Column field="description" header="Description"></Column>
            <Column field="elements" header="Elements"></Column>
            <Column field="methodcode" header="Method Code"></Column>
            <Column field="comments" header="Comments"></Column>
            <Column
              :exportable="false"
              style="min-width: 8rem"
              header="Actions"
            >
              <template #body="slotProps">
                <Button
                  v-bind:title="editMsg"
                  icon="pi pi-pencil"
                  class="p-button-rounded p-button-success mr-2"
                  @click="editItem(slotProps)"
                />
              </template>
            </Column>
          </DataTable>
        </div>
      </div>
    </div>
    <!-- row -->

    <hr class="mg-t-30 mg-b-30" />

    <div class="row flex-column-reverse flex-lg-row">
      <div class="col-lg-6">
        <a :href="dashboard" class="btn btn-white tx-13 btn-uppercase"
          ><i data-feather="arrow-left" class="mg-r-5"></i> Back to Dashboard</a
        >
      </div>
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
  <DynamicDialog />
  <ConfirmDialog></ConfirmDialog>
</template>
<script>
import item from "../../components/item/item";
import { h } from "vue";
import Button from "primevue/button";
export default {
  props: ["transmittal"],
  data() {
    return {
      dashboard: this.$env_Url + "/qaqcreceiver/dashboard",
      loading: true,
      items: [],
      itemFile: null,
      COCitemFile: null,
      cocPath: this.transmittal.coc_path,
      fileLabel: "Choose File",
      editMsg: "Update Item",
      cocFileLabel: "Choose File",
      form: {
        id: this.transmittal.id,
        cocFile: this.transmittal.cocFile,
        csvFile: this.transmittal.csvFile,
        transmittalno: this.transmittal.transmittalno,
        purpose: this.transmittal.purpose,
        datesubmitted: "",
        timesubmitted: this.transmittal.timesubmitted.replace(
          ":00.0000000",
          ""
        ),
        date_needed: "",
        priority: this.transmittal.priority,
        status: this.transmittal.status,
        email_address: this.transmittal.email_address,
        source: this.transmittal.source,
        transType: this.transmittal.transType,
      },
    };
  },
  created() {
    this.fetchItems();
    this.loading = false;
  },
  mounted() {
    document.getElementById("date-needed").value = this.transmittal.date_needed;
    document.getElementById("date-submitted").value =
      this.transmittal.datesubmitted;
    this.cocFileLabel = this.transmittal.cocFile;
  },
  updated() {
    var transno = this.form.transmittalno;
    if (transno == null) {
      transno = "";
    }
  },
  methods: {
    async fetchItems() {
      const res = await this.callApiwParam(
        "post",
        "/transItem/getItems",
        this.form
      );
      this.items = res.data;
    },
    editItem(data) {
      this.showDialog(data.data);
    },
    showDialog(data) {
      const dialogRef = this.$dialog.open(item, {
        props: {
          header: "Transmittal item",
          style: {
            width: "50vw",
          },
          breakpoints: {
            "960px": "75vw",
            "640px": "90vw",
          },
          modal: true,
        },
        data: {
          transmittalno: this.form.transmittalno,
          id: data.id,
          sampleno: data.sampleno,
          samplewtvolume: data.samplewtvolume,
          description: data.description,
          elements: data.elements,
          methodcode: data.methodcode,
          comments: data.comments,
          isDeptUser: false,
          isReceiving: true,
          source: this.form.source
        },
        onClose: (options) => {
          this.fetchItems();
        },
      });
    },
  },
};
</script>
