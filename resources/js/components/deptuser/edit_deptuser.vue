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
              <a :href="dashboard">Dept. Requesters</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Edit Transmittal - Dept.User</h4>
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
            <label for="customFile" class="mg-r-10"
              >Attached COC
              <span class="text-danger" aria-required="true"> * </span></label
            >
            <div class="custom-file mb-0 mb-lg-2">
              <input
                type="file"
                class="custom-file-input"
                id="customFile"
                ref="cocFile"
                name="attached-csv"
                @change="onCoCFileChange"
              />
              <label
                class="custom-file-label"
                for="customFile"
                data-button-label="Upload"
                >{{ cocFileLabel }}</label
              >
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="form-group">
          <label for="transmittal-no"
            >Transmittal No.<span class="text-danger" aria-required="true">
              *
            </span></label
          >
          <input
            type="text"
            class="form-control"
            id="transmittal-no"
            name="transmittal-no"
            v-model="form.transmittalno"
            @change="onTransmittalNoChange"
            disabled="true"
          />
        </div>

        <div class="row row-sm">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="date-submitted"
                >Date Submitted<span class="text-danger" aria-required="true">
                  *
                </span></label
              >
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
              <label for="time-submitted"
                >Time Submitted<span class="text-danger" aria-required="true">
                  *
                </span></label
              >
              <input
                type="time"
                class="form-control"
                id="time-submitted"
                name="time-submitted"
                v-model="form.timesubmitted"
                disabled="true"
              />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="email-address"
            >Email Address<span class="text-danger" aria-required="true">
              *
            </span></label
          >
          <input
            type="email"
            class="form-control"
            id="email-address"
            name="email-address"
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
                v-model="form.purpose"
              />
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="type">Type<span class="text-danger" aria-required="true">
                  *
                </span></label>
              <select
                class="custom-select tx-base"
                id="type"
                name="type"
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
              <label for="date-needed"
                >Date Needed<span class="text-danger" aria-required="true">
                  *
                </span></label
              >
              <input
                type="text"
                class="form-control"
                id="date-needed"
                name="date-needed"
                pattern="\d{2}\/\d{2}\/\d{4}"
                placeholder="mm/dd/yyyy"
              />
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label for="priority"
                >Priority<span class="text-danger" aria-required="true">
                  *
                </span></label
              >
              <select
                class="custom-select tx-base"
                id="priority"
                v-model="form.priority"
                name="priority"
              >
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
              </select>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label for="status"
                >Status<span class="text-danger" aria-required="true">
                  *
                </span></label
              >
              <select
                class="custom-select tx-base"
                id="status"
                name="status"
                v-model="form.status"
                disabled="true"
              >
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="source"
            >Source<span class="text-danger" aria-required="true">
              *
            </span></label
          >
          <input
            type="text"
            class="form-control"
            id="source"
            name="source"
            v-model="form.source"
          />
        </div>
      </div>
      <div class="col-lg-12">
        <hr class="mg-t-10 mg-b-30" />
      </div>
    </div>

    <div class="row row-xs">
      <div class="col-lg-6 d-flex justify-content-start">
        <button
          class="btn btn-primary tx-13 btn-uppercase mr-2 mb-2 ml-lg-1 mr-lg-0"
          @click="showDialog"
          :disabled="disableUpload"
        >
          <i data-feather="plus" class="mg-r-5"></i> Add Item
        </button>
        <a
          :href="this.templatePath + '/template/Item Template.csv'"
          class="btn btn-success tx-13 btn-uppercase mr-2 mb-2 ml-lg-1 mr-lg-0"
        >
          <i data-feather="download" class="mg-r-5"></i> Download Item Template
        </a>
      </div>
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
                  v-bind:title="edititem"
                  icon="pi pi-pencil"
                  class="p-button-rounded p-button-success mr-2"
                  @click="editItem(slotProps)"
                />
                <Button
                  v-bind:title="deleteitem"
                  icon="pi pi-trash"
                  class="p-button-rounded p-button-warning mr-2"
                  @click="deleteItem(slotProps)"
                />
              </template>
            </Column>
          </DataTable>
        </div>
      </div>
    </div>
    <!-- row -->

    <hr class="mg-t-30 mg-b-30" />

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
            <input type="hidden" v-model="form.itemFile" />
            <label for="customFile" class="mg-r-10">Attached CSV</label>
            <div class="custom-file mb-0 mb-lg-2">
              <input
                type="file"
                class="custom-file-input"
                id="customFile"
                ref="file"
                name="attached-csv"
                v-on:change="onFileChange"
                :disabled="disableUpload"
                accept=".csv"
              />
              <label
                class="custom-file-label"
                for="customFile"
                data-button-label="Browse"
                >{{ fileLabel }}</label
              >
            </div>
            <button
              type="submit"
              class="
                btn btn-primary
                tx-13
                btn-uppercase
                mr-2
                mb-2
                ml-lg-1
                mr-lg-0
              "
              :disabled="disableUpload"
              @click.prevent="uploadItem"
            >
              <i data-feather="upload" class="mg-r-5"></i> Upload
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="row flex-column-reverse flex-lg-row">
      <div class="col-lg-6">
        <a :href="dashboard" class="btn btn-white tx-13 btn-uppercase"
          ><i data-feather="arrow-left" class="mg-r-5"></i> Back to Dashboard</a
        >
      </div>
      <div class="col-lg-6 d-flex justify-content-start justify-content-lg-end">
        <a
          :href="dashboard"
          class="btn btn-white tx-13 btn-uppercase mr-2 mb-2 ml-lg-1 mr-lg-0"
        >
          <i data-feather="x-circle" class="mg-r-5"></i> Cancel
        </a>
        <button
          type="submit"
          class="btn btn-primary tx-13 btn-uppercase mr-2 mb-2 ml-lg-1 mr-lg-0"
          @click.prevent="saveTransmittal"
        >
          <i data-feather="save" class="mg-r-5"></i> Save
        </button>
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
      dashboard: this.$env_Url + "/deptuser/dashboard",
      loading: true,
      disableUpload: true,
      items: [],
      itemFile: null,
      COCitemFile: null,
      fileLabel: "Choose File",
      cocFileLabel: "Choose File",
      errors_exist: false,
      errors: {},
      seconds: 0,
      templatePath: window.location.origin,
      form: {
        id: this.transmittal.id,
        transmittalno: this.transmittal.transmittalno,
        purpose: this.transmittal.purpose,
        datesubmitted: "",
        timesubmitted: "",
        date_needed: "",
        priority: this.transmittal.priority,
        status: this.transmittal.status,
        email_address: this.transmittal.email_address,
        source: this.transmittal.source,
        transType : this.transmittal.transType,
      },
    };
  },
  created() {
    this.fetchItems();
    this.loading = false;
  },
  mounted() {
    document.getElementById("date-needed").value = this.transmittal.date_needed;
    document.getElementById("date-submitted").value = this.transmittal.datesubmitted;
    this.cocFileLabel = this.transmittal.cocFile;
    if (this.transmittal.timesubmitted != null) {
      this.form.timesubmitted = this.transmittal.timesubmitted.replace(
        ":00.0000000",
        ""
      );
    }
    // this.tempInsert();
  },
  updated() {
    this.disableUpload = true;
    var transno = this.form.transmittalno;
    if (transno == null) {
      transno = "";
    }
    if (transno != "") {
      this.disableUpload = false;
    }
  },
  methods: {
    onFileChange(e) {
      this.fileLabel = "";
      this.itemFile = this.$refs.file.files[0];
      this.fileLabel = this.itemFile.name;
    },
    onCoCFileChange(e) {
      this.cocFileLabel = "";
      this.COCitemFile = this.$refs.cocFile.files[0];
      this.cocFileLabel = this.COCitemFile.name;
    },
    onTransmittalNoChange() {
      this.fetchItems();
    },
    async fetchItems() {
      const res = await this.callApiwParam(
        "post",
        "/transItem/getItems",
        this.form
      );
      this.items = res.data;
    },
    async uploadItem() {
      this.fileLabel = this.form.transmittalno + "_" + this.fileLabel;
      let form = new FormData();
      form.append("itemFile", this.itemFile);
      _.each(this.form, (value, key) => {
        form.append(key, value);
      });
      const res = await this.submit("post", "/transItem/uploaditems", form, {
        headers: {
          "Content-Type":
            "multipart/form-data; charset=utf-8; boundary=" +
            Math.random().toString().substr(2),
        },
      });
      if (res.status === 200) {
        this.smessage();
        this.fetchItems();
      } else {
        this.ermessage(res.data.errors);
      }
    },
    async saveTransmittal() {
      this.form.date_needed = document.getElementById("date-needed").value;
      this.form.datesubmitted = document.getElementById("date-submitted").value;

      let form = new FormData();
      if (this.COCitemFile != null) {
        form.append("cocFile", this.COCitemFile);

        this.cocFileLabel = this.form.transmittalno + "_" + this.cocFileLabel;
      }
      _.each(this.form, (value, key) => {
        form.append(key, value);
      });

      const res = await this.submit("post", "/deptuser/update", form, {
        headers: {
          "Content-Type":
            "multipart/form-data; charset=utf-8; boundary=" +
            Math.random().toString().substr(2),
        },
      });
      if (res.status === 200) {
        this.updmessage();
      } else {
        this.errors_exist = true;
        this.errors = res.data.errors;
      }
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
          description: data.description,
          elements: data.elements,
          methodcode: data.methodcode,
          comments: data.comments,
          isDeptUser: true,
          isReceiving: false,
          source: this.form.source
        },
        onClose: (options) => {
          this.fetchItems();
        },
      });
    },
    deleteItem(data) {
      let src = data.data.id,
        alt = data.data.id;
      this.form.itemID = alt;

      this.$confirm.require({
        message: "Do you want to delete this item?",
        header: "Delete Confirmation",
        icon: "pi pi-info-circle",
        acceptClass: "p-button-danger",
        accept: async () => {
          const res = await this.deleteRecord("post", "/transItem/delete", {
            id: data.data.id,
          });
          if (res.status === 200) {
            this.rmessage();
            this.fetchItems();
          } else {
            this.ermessage();
          }
        },
      });
    },
    editItem(data) {
      this.showDialog(data.data);
    },
    // async autosave() {
    //   this.seconds = this.seconds + 1;
    //   if (this.seconds == 30) {
    //     var purpose = this.form.purpose;
    //     var email_address = this.form.email_address;
    //     var source = this.form.source;
    //     if (this.form.transmittalno != "" || this.form.transmittalno != null) {
    //       if (this.form.purpose == null) {
    //         this.form.purpose = "";
    //       }
    //       if (this.form.email_address == null) {
    //         this.form.email_address = "";
    //       }
    //       if (this.form.source == null) {
    //         this.form.source = "";
    //       }
    //       this.form.date_needed = document.getElementById("date-needed").value;
    //       this.form.datesubmitted =
    //         document.getElementById("date-submitted").value;
    //       let form = new FormData();
    //       if (this.COCitemFile != null) {
    //         form.append("cocFile", this.COCitemFile);
    //       }
    //       _.each(this.form, (value, key) => {
    //         form.append(key, value);
    //       });
    //       const res = await this.submit("post", "/deptuser/autosave", form, {
    //         headers: {
    //           "Content-Type":
    //             "multipart/form-data; charset=utf-8; boundary=" +
    //             Math.random().toString().substr(2),
    //         },
    //       });
    //       if (res.status === 200) {
    //         this.form.id = res.data.id;
    //       }
    //     }
    //     this.seconds = 0;
    //   }
    // },
    // tempInsert: function () {
    //   setInterval(() => {
    //     this.autosave();
    //   }, 1000);
    // },
  },
};
</script>
