<template>
  <div v-if="errors_exist" class="alert alert-danger" role="alert">
    Whoops! Something didn't work.
    <ul>
      <div v-for="error in errors" :key="error.id">
        <li>{{ error[0] }}</li>
      </div>
    </ul>
  </div>
  <form role="form" method="GET" action="">
    <div class="modal-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive-lg">
            <DataTable
              ref="dt"
              :value="itemsList"
              v-model:selection="selectedSample"
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
              <template #header>
                <span class="text-danger tx-15"> {{ message }}</span>
              </template>
              <Column
                selectionMode="multiple"
                style="width: 3rem"
                :exportable="false"
              ></Column>
              <Column header="Sample No.">
                <template #body="slotProps">
                  {{ slotProps.index + 1 }}
                </template></Column
              >
              <Column field="id" hidden="true"></Column>
              <Column field="sampleno" header="Sample Code"></Column>
              <Column
                field="source"
                header="Source"
                style="min-width: 8rem"
              ></Column>
              <Column field="samplewtgrams" header="Sample Wt.(Grams)"></Column>
              <Column field="crusibleused" header="Crusible Used"></Column>
              <Column field="transmittalno" header="Transmittal No."></Column>
              <Column field="fluxg" header="Flux (Grams)"></Column>
              <Column field="flourg" header="Flour (Grams)"></Column>
              <Column field="niterg" header="Niter (Grams)"></Column>
              <Column field="leadg" header="Lead (Grams)"></Column>
              <Column field="silicang" header="Silican (Grams)"></Column>
            </DataTable>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button
          type="reset"
          class="btn btn-white tx-13 btn-uppercase"
          @click.prevent="closeDialog"
        >
          <i data-feather="x-circle" class="mg-r-5"></i> Cancel
        </button>
        <button
          type="submit"
          class="btn btn-primary tx-13 btn-uppercase"
          @click.prevent="saveItem"
        >
          <i data-feather="save" class="mg-r-5"></i> Save
        </button>
      </div>
    </div>
  </form>
</template>
<script>
export default {
  inject: ["dialogRef"],
  data() {
    return {
      isDeptUser: this.dialogRef.data.isDeptUser,
      isReceiving: this.dialogRef.data.isReceiving,
      errors_exist: false,
      errors: {},
      isdisabled: true,
      itemsList: this.dialogRef.data.itemsList,
      selectedSample: [],
      message: "0 sample/s selected!",
      form: {
        labbatch: this.dialogRef.data.labbatch,
        itemIds: "",
      },
    };
  },
  updated() {
    if (this.selectedSample.length > 0) {
      var ids = "";
      this.selectedSample.forEach(function (element, index) {
        if (index == 0) {
          ids = element.id;
        } else {
          ids = ids + "," + element.id;
        }
      });
    }
    this.message = this.selectedSample.length + " sample/s selected!";
    this.form.itemIds = ids;
  },
  methods: {
    closeDialog() {
      this.dialogRef.close();
    },
    async saveItem() {
      if (this.selectedSample.length > 0) {
        const res = await this.submit("post", "/assayer/addSample", this.form, {
          headers: {
            "Content-Type":
              "multipart/form-data; charset=utf-8; boundary=" +
              Math.random().toString().substr(2),
          },
        });
        if (res.status === 200) {
          this.dialogRef.close(this.form);
        } else {
          this.errors_exist = true;
          this.errors = res.data.errors;
        }
      }
      else
      {
        this.errors = {
          error: ["Select atleast 1 sample!"],
        };
         this.errors_exist = true;
      }
    },
  },
};
</script>