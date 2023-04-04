<template>
  <div>
    <el-card class="box-card mb-5">
      <h4 class="mb-0">SMS Form</h4>
    </el-card>

    <el-form ref="smsForm" :model="form" :rules="rules" label-width="120px">
      <el-form-item label="Message" prop="message">
        <el-input v-model="form.message" type="textarea" rows="4"></el-input>
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
          clearable
        >
          <el-option
            v-for="department in departments"
            :key="department.id"
            :label="department.name"
            :value="department.id"
          ></el-option>
        </el-select>
      </el-form-item>

      <el-form-item label="Employees">
        <el-checkbox
          v-model="form.selectAllEmployees"
          @change="selectAllEmployees"
        >
          Select All
        </el-checkbox>
        <el-select
          v-model="form.employees"
          placeholder="Select Employees"
          multiple
        >
          <el-option
            v-for="employee in employees"
            :key="employee.id"
            :label="employee.name"
            :value="employee.id"
          ></el-option>
        </el-select>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      form: {
        selectAllEmployees: false,
        employees: [],
      },

      rules: {
        company_id: [
          {
            required: true,
            message: "Please select a company",
            trigger: "change",
          },
        ],
        employees: [
          {
            required: true,
            type: "array",
            min: 1,
            message: "Please select at least one employee",
            trigger: "change",
          },
        ],
      },
    };
  },

  computed: {
    ...mapGetters("Employee", ["employees"]),
    ...mapGetters("Company", ["companies"]),
    ...mapGetters("Department", ["departments"]),
  },

  mounted() {
    this.fetchCompanies({ size: 500 });
  },

  methods: {
    ...mapActions("Employee", ["fetchEmployees"]),
    ...mapActions("Company", ["fetchCompanies"]),
    ...mapActions("Department", ["fetchDepartments"]),

    selectAllEmployees() {
      if (this.form.selectAllEmployees) {
        const employeeIds = this.employees.map((employee) => employee.id);
        console.log(employeeIds);
        this.form.employees = [...employeeIds];
      } else {
        this.form.employees = [];
      }
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
          console.log("tepi");
          this.fetchEmployees({
            size: 500,
            company_id: this.form.company_id,
          });
        }
      },
      immediate: true,
    },

    "form.department_id": {
      handler() {
        if (this.form.department_id) {
          this.fetchEmployees({
            size: 500,
            department_id: this.form.department_id,
          });
        }

        if (this.form.company_id) {
          this.fetchEmployees({
            size: 500,
            company_id: this.form.company_id,
          });
        }
      },
      immediate: true,
    },

    "form.employees": {
      handler(val) {
        if (this.form.employees) {
          if (val.length === this.employees.length) {
            //this.form.selectAllEmployees = true;
          } else {
            this.form.selectAllEmployees = false;
          }
        }
      },
      deep: true,
    },
  },
};
</script>

<style>
</style>