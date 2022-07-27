
<template>
     <div class="content-auth">
       <button id="themeMode" type="button" class="btn btn-white rounded-circle ht-50-f wd-50-f position-absolute t-20 r-20 z-index-10 theme-mode mr-0">
          <i data-feather="moon"></i>
        </button>
        <div class="row no-gutters">
          <div class="col-lg-6">
            <div class="signin-hero" data-hero-dark="url(../assets/img/admin-signin-dark.svg)"></div>
          </div>
          <div class="col-lg-6">
            <div class="sign-wrapper wd-100p-f mx-wd-500 px-lg-4">
              <div class="wd-100p">
                <h3 class="mg-b-3">Log In</h3>
                <p class="tx-color-03 mg-b-0">Welcome to LIMS Admin Portal.</p>
                <p class="tx-color-03 mg-b-40">Please sign in to continue.</p>
                <p v-if="errors.length">
                    <ul class="list-group">
                      <li v-for="error in errors" :key="error" class="list-group-item list-group-item-danger">{{ error }}</li>
                    </ul>
                </p>  
                <form @submit="login">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" v-model="input.username" placeholder="Enter your username">
                  </div>
                  <div class="form-group">
                    <div class="d-flex justify-content-between mg-b-5">
                    <label for="password" class="mg-b-0-f">Password</label>
                    <a href="forgot-password.html" class="tx-secondary">Forgot password?</a>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" v-model="input.password" placeholder="•••••••">
                  </div>
                  <!-- <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Login</button>
                                &nbsp;
                                <a :href="forgot_password" class="btn btn-info btn-sm">Forgot Password</a>
                                
                            </div>      -->
                  <button class="btn btn-primary tx-13 btn-uppercase" type="submit">Login</button>
                </form>
                <div class="cms-footer mg-t-50">
                  <hr>
                  <p class="tx-gray-500 tx-10">Admin Portal v1.0 • Developed by WebFocus Solutions, Inc. 2022</p>
                </div>
              </div>
            </div><!-- sign-wrapper -->
          </div>
        </div>
      </div><!-- content -->
</template>

<script  type="application/javascript">
const env_Url = process.env.MIX_APP_URL;
export default {
  name: "Login",
  data() {
    return {
      errors: [],
      result: "",
      forgot_password: this.$env_Url + "/auth/forgot_password",
      input: {
        username: "",
        password: "",
        passexpiration: 0,
      },
    };
  },
  methods: {
    login: function (e) {
      this.errors = [];
      if (!this.input.username) {
        this.errors.push("Username required!");
      } else if (!this.input.password) {
        this.errors.push("Password required!");
      } else {
        axios
          .post(this.$env_Url + "/auth/login", this.input)
          .then((response) => {
            if (response.data.result == "Success") {
              window.location.href = this.$env_Url + "/deptuser/dashboard";
            } else {
              this.errors.push("Invalid Credential.");
            }
          })
          .catch(function (error) {});
      }

      e.preventDefault();
    },
  },
};
</script>