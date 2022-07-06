<template>
  <form role="form" method="GET" action="">
    <div class="modal-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label for="transmittal-no">Transmittal No.</label>
            <input
              type="number"
              class="form-control input-sm"
              v-model="form.transmittalno"
              disabled="true"
            />
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label for="sample-no">Sample No.</label>
            <input
              type="number"
              class="form-control input-sm"
              id="sample-no"
              name="sample-no"
              v-model="form.sampleno"
            />
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label for="drescription">Description</label>
            <textarea
              class="form-control input-sm"
              id="drescription"
              name="drescription"
              v-model="form.description"
            ></textarea>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label for="elements">Elements</label>
            <input
              type="text"
              class="form-control input-sm"
              id="elements"
              name="elements"
              v-model="form.elements"
            />
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label for="method-code">Method Code</label>
            <input
              type="text"
              class="form-control input-sm"
              id="method-code"
              name="method-code"
              v-model="form.methodcode"
            />
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label for="comments">Comments</label>
            <textarea
              class="form-control input-sm"
              id="comments"
              name="comments"
              v-model="form.comments"
            ></textarea>
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
      <button type="submit" class="btn btn-primary tx-13 btn-uppercase" @click.prevent="saveItem">
        <i data-feather="save" class="mg-r-5"></i> Save
      </button>
    </div>
  </form>
</template>
<script>
export default {
  inject: ["dialogRef"],
  data() {
    return {
      form: {
        transmittalno: this.dialogRef.data.transmittalno,
        id:this.dialogRef.data.id,
        sampleno: this.dialogRef.data.sampleno,
        description: this.dialogRef.data.description,
        elements: this.dialogRef.data.elements,
        methodcode: this.dialogRef.data.methodcode,
        comments: this.dialogRef.data.comments,
      },
    };
  },
  methods: {
    closeDialog() {
      this.dialogRef.close();
    },
    async saveItem() {
    var url = "/transItem/store";
     if(this.form.id != undefined){
        url = "/transItem/update"
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
        this.ermessage(res.data.errors);
      }
    },
  },
};
</script>