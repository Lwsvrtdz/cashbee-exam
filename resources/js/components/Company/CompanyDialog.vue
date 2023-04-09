<template>
  <el-dialog
    :title="dialogTitle"
    :visible.sync="dialogVisible"
    :close-on-click-modal="false"
  >
    <el-form ref="companyForm" :model="form" :rules="rules" label-width="120px">
      <el-form-item label="Name" prop="name">
        <el-input v-model="form.name"></el-input>
      </el-form-item>
      <el-form-item label="Description" prop="description">
        <el-input v-model="form.description"></el-input>
      </el-form-item>
    </el-form>

    <div slot="footer" class="dialog-footer">
      <el-button @click="dialogVisible = false">Cancel</el-button>
      <el-button type="primary" @click="submitForm">Save</el-button>
    </div>
  </el-dialog>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      dialogTitle: "Add Company",
      dialogVisible: false,
      form: {
        name: "",
        description: "",
      },
      rules: {
        name: [
          { required: true, message: "Please enter a name", trigger: "blur" },
        ],
        description: [
          {
            required: true,
            message: "Please enter a description",
            trigger: "blur",
          },
        ],
      },
    };
  },
  methods: {
    ...mapActions("Company", [
      "saveCompany",
      "updateCompany",
      "fetchCompanies",
    ]),

    openDialog(title, company) {
      this.dialogTitle = title;
      this.dialogVisible = true;
      if (company) {
        this.form = { ...company };
      } else {
        this.form = {
          name: "",
          description: "",
        };
      }
    },

    submitForm() {
      this.$refs.companyForm.validate((valid) => {
        if (valid) {
          if (this.dialogTitle === "Add Company") {
            this.saveCompany(this.form).then(() => {
              this.dialogVisible = false;
            });
          } else {
            this.updateCompany(this.form).then(() => {
              this.dialogVisible = false;
            });
          }
          this.fetchCompanies({ size: 500 });
        } else {
          return false;
        }
      });
    },
  },
};
</script>

<style>
</style>
