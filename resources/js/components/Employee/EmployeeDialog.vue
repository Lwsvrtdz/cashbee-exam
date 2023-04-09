<template>
  <el-dialog
    :title="dialogTitle"
    :visible.sync="dialogVisible"
    :close-on-click-modal="false"
  >
    <el-form
      ref="employeeForm"
      :model="form"
      :rules="rules"
      label-width="120px"
    >
      <el-form-item label="Name" prop="name">
        <el-input v-model="form.name"></el-input>
      </el-form-item>
      <el-form-item label="Phone" prop="phone_number">
        <el-input v-model="form.phone_number"></el-input>
      </el-form-item>
      <el-form-item label="Company" prop="company_id">
        <el-select v-model="form.company_id" placeholder="Select Company">
          <el-option
            v-for="company in companies"
            :key="company.id"
            :label="company.name"
            :value="company.id"
          ></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Department" prop="department_id">
        <el-select
          v-model="form.department_id"
          placeholder="Select Department"
          :disabled="!form.company_id"
        >
          <el-option
            v-for="department in departments"
            :key="department.id"
            :label="department.name"
            :value="department.id"
          ></el-option>
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

const validatePhilippinePhoneNumber = (rule, value, callback) => {
  const regex = /^(09|\+639)\d{9}$/; // Philippine mobile number regex pattern
  if (value && !regex.test(value)) {
    callback(new Error("Please enter a valid Philippine phone number"));
  } else {
    callback();
  }
};

export default {
  data() {
    return {
      dialogTitle: "Add Employee",
      dialogVisible: false,
      form: this.generateDefaultEmployeeForm(),
      rules: {
        name: [
          { required: true, message: "Please enter a name", trigger: "blur" },
        ],
        phone_number: [
          {
            required: true,
            message: "Please enter a phone_number number",
            trigger: "blur",
          },
          {
            min: 10,
            message: "Phone number must be at least 10 characters long",
            trigger: "blur",
          },

          { validator: validatePhilippinePhoneNumber, trigger: "blur" },
        ],
        company_id: [
          {
            required: true,
            message: "Please select a company",
            trigger: "blur",
          },
        ],
      },
    };
  },

  computed: {
    ...mapGetters("Company", ["companies"]),
    ...mapGetters("Department", ["departments"]),
  },

  mounted() {
    this.fetchCompanies({ size: 500 });
  },

  methods: {
    ...mapActions("Employee", [
      "saveEmployee",
      "updateEmployee",
      "fetchEmployees",
    ]),

    ...mapActions("Company", ["fetchCompanies"]),
    ...mapActions("Department", ["fetchDepartments"]),

    openDialog(title, employee) {
      this.dialogTitle = title;
      this.dialogVisible = true;
      if (employee) {
        this.form = { ...employee };
      } else {
        this.form = this.generateDefaultEmployeeForm();
      }
    },

    submitForm() {
      this.$refs.employeeForm.validate((valid) => {
        if (valid) {
          if (this.dialogTitle === "Add Employee") {
            this.saveEmployee(this.form).then(() => {
              this.dialogVisible = false;
            });
          } else {
            this.updateEmployee(this.form).then(() => {
              this.dialogVisible = false;
            });
          }
          this.fetchEmployees({ size: 500 });
        } else {
          console.log("fail");
          return false;
        }
      });
    },

    generateDefaultEmployeeForm() {
      return {
        name: "",
        phone_number: "",
        company_id: null,
        department_id: null,
      };
    },
  },

  watch: {
    "form.company_id": {
      handler() {
        if (this.form.company_id) {
          this.fetchDepartments({
            size: 500,
            company_id: this.form.company_id,
          });
        }
      },
      immediate: true,
    },
  },
};
</script>

<style>
</style>