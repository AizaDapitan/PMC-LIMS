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
          <div class="form-group">
            <label for="transmittal-no">Transmittal No.</label>
            <input
              class="form-control input-sm"
              v-model="form.transmittalno"
              disabled="true"
            />
          </div>
        </div>
        <div class="col-lg-12"></div>
        <div class="col-lg-12">
          <div class="form-group">
            <label for="sample-no" v-if="!this.form.isAssayer"
              >Sample No.<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <label for="sample-no" v-else
              >Sample Code<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <input
              class="form-control input-sm"
              id="sample-no"
              name="sample-no"
              v-model="form.sampleno"
              :disabled="this.isdisabled"
            />
          </div>
        </div>
        <div v-if="!this.form.isAssayer" class="col-lg-12">
          <div class="form-group">
            <label for="drescription"
              >Description<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <textarea
              class="form-control input-sm"
              id="drescription"
              name="drescription"
              v-model="form.description"
              :disabled="!this.isDeptUser"
            ></textarea>
          </div>
          <div class="form-group">
            <label for="elements"
              >Elements<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <input
              type="text"
              class="form-control input-sm"
              id="elements"
              name="elements"
              v-model="form.elements"
              :disabled="!this.isDeptUser"
            />
          </div>
          <div class="form-group">
            <label for="method-code"
              >Method Code<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <input
              type="text"
              class="form-control input-sm"
              id="method-code"
              name="method-code"
              v-model="form.methodcode"
              :disabled="!this.isDeptUser"
            />
          </div>
          <div class="form-group">
            <label for="comments">Comments</label>
            <textarea
              class="form-control input-sm"
              id="comments"
              name="comments"
              v-model="form.comments"
              :disabled="!this.isDeptUser"
            ></textarea>
          </div>
          <div class="form-group">
            <label for="sample-no"
              >Sample Wt./Volume<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <input
              type="number"
              class="form-control input-sm"
              v-model="form.samplewtvolume"
              :disabled="!this.isReceiving"
            />
          </div>
        </div>
        <div v-if="this.form.isAssayer" class="col-lg-12">
          <div class="form-group">
            <label for="source">Source</label>
            <input
              class="form-control input-sm"
              v-model="form.source"
              disabled="true"
            />
          </div>
          <div class="form-group">
            <label for="sample-no"
              >Sample Weight (Grams)<span
                class="text-danger"
                aria-required="true"
              >
                *
              </span></label
            >
            <input
              type="number"
              class="form-control input-sm"
              v-model="form.samplewtgrams"
            />
          </div>
          <div class="form-group">
            <label for="sample-no"
              >Crusible Used<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <input
              class="form-control input-sm"
              v-model="form.crusibleused"
            />
          </div>
          <h4>Elements</h4>
          <div class="form-group">
            <label for="sample-no"
              >Flux (Grams)<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <input
              type="number"
              class="form-control input-sm"
              v-model="form.fluxg"
            />
          </div>
          <div class="form-group">
            <label for="sample-no"
              >Flour (Grams)<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <input
              type="number"
              class="form-control input-sm"
              v-model="form.flourg"
            />
          </div>
          <div class="form-group">
            <label for="sample-no"
              >Niter (Grams)<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <input
              type="number"
              class="form-control input-sm"
              v-model="form.niterg"
            />
          </div>
          <div class="form-group">
            <label for="sample-no"
              >Lead (Grams)<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <input
              type="number"
              class="form-control input-sm"
              v-model="form.leadg"
            />
          </div>
          <div class="form-group">
            <label for="sample-no"
              >Silican (Grams)<span class="text-danger" aria-required="true">
                *
              </span></label
            >
            <input
              type="number"
              class="form-control input-sm"
              v-model="form.silicang"
            />
          </div>
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
  </form>
  <toast
    :breakpoints="{ '920px': { width: '100%', right: '0', left: '0' } }"
  ></toast>
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
      form: {
        transmittalno: this.dialogRef.data.transmittalno,
        id: this.dialogRef.data.id,
        sampleno: this.dialogRef.data.sampleno,
        samplewtvolume: this.dialogRef.data.samplewtvolume,
        description: this.dialogRef.data.description,
        elements: this.dialogRef.data.elements,
        methodcode: this.dialogRef.data.methodcode,
        comments: this.dialogRef.data.comments,
        source: this.dialogRef.data.source,
        receiving: this.dialogRef.data.isReceiving,
        samplewtgrams: this.dialogRef.data.samplewtgrams,
        fluxg: this.dialogRef.data.fluxg,
        flourg: this.dialogRef.data.flourg,
        niterg: this.dialogRef.data.niterg,
        leadg: this.dialogRef.data.leadg,
        silicang: this.dialogRef.data.silicang,
        crusibleused: this.dialogRef.data.crusibleused,
        isAssayer: this.dialogRef.data.isAssayer,
        labbatch :this.dialogRef.data.labbatch,
      },
    };
  },
  mounted() {
    if (this.dialogRef.data.sampleno == undefined || this.isDeptUser) {
      this.isdisabled = false;
    }
  },
  methods: {
    closeDialog() {
      this.dialogRef.close();
    },
    async saveItem() {
      var url = "/transItem/store";
      if (this.form.id != undefined) {
        url = "/transItem/update";
      }
      const res = await this.submit("post", url, this.form, {
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
        // this.ermessage(res.data.errors);
      }
    },
  },
};
</script>