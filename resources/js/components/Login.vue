<template>
  <div class="d-flex justify-content-center align-items-center">
    <el-form
      ref="form"
      :model="form"
      :rules="loginRules"
      label-position="left"
      label-width="120px"
      class="login-form"
    >
      <el-form-item label="Email" prop="email">
        <el-input v-model="form.email"></el-input>
      </el-form-item>
      <el-form-item label="Password" prop="password">
        <el-input type="password" v-model="form.password"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="submitForm('form')">Login</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      loginRules: {
        email: [
          {
            type: "email",
            required: true,
            message: "Please input your email",
            trigger: "blur",
          },
        ],
        password: [
          {
            required: true,
            message: "Please input your password",
            trigger: "blur",
          },
        ],
      },
    };
  },

  mounted() {},

  methods: {
    ...mapActions("auth", ["login"]),

    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.login(this.form).then((response) => {
            localStorage.setItem("token", response.data);
          });
        } else {
          return false;
        }
      });
    },
  },
};
</script>
