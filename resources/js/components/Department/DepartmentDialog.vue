<template>
  <el-dialog
    :title="dialogTitle"
    :visible.sync="dialogVisible"
    :close-on-click-modal="false"
    :before-close="handleClose"
  >
    <el-form
      ref="departmentForm"
      :model="form"
      :rules="rules"
      label-width="120px"
    >
      <el-form-item label="Name" prop="name">
        <el-input v-model="form.name"></el-input>
      </el-form-item>
      <el-form-item label="Description" prop="description">
        <el-input v-model="form.description"></el-input>
      </el-form-item>
      <el-form-item label="Company" prop="company_id">
        <el-select v-model="form.company_id" placeholder="Select a company">
          <el-option
            v-for="company in companies"
            :key="company.id"
            :value="company.id"
            :label="company.name"
          />
        </el-select>
      </el-form-item>
    </el-form>

    <div slot="footer" class="dialog-footer">
      <el-button @click="dialogVisible = false">Cancel</el-button>
      <el-button type="primary" @click="submitForm">Save</el-button>
    </div>
  </el-dialog>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  data() {
    return {
      dialogTitle: "Add Department",
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

  computed: {
    ...mapGetters("Company", ["companies"]),
  },

  mounted() {
    this.fetchCompanies({ size: 500 });
  },

  methods: {
    ...mapActions("Department", [
      "saveDepartment",
      "updateDepartment",
      "fetchDepartments",
    ]),

    ...mapActions("Company", ["fetchCompanies"]),

    openDialog(title, department) {
      this.dialogTitle = title;
      this.dialogVisible = true;
      if (department) {
        this.form = { ...department };
      } else {
        this.form = {
          name: "",
          description: "",
        };
      }
    },

    handleClose(done) {
      this.$refs.departmentForm.validate((valid) => {
        if (valid) {
          done();
        } else {
          return false;
        }
      });
    },

    submitForm() {
      this.$refs.departmentForm.validate((valid) => {
        if (valid) {
          if (this.dialogTitle === "Add Department") {
            this.saveDepartment(this.form).then(() => {
              this.dialogVisible = false;
            });
          } else {
            this.updateDepartment(this.form).then(() => {
              this.dialogVisible = false;
            });
          }
          this.fetchDepartments({ size: 500 });
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
