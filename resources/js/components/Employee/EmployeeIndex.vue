<template>
  <div>
    <el-card class="box-card mb-5">
      <h4 class="mb-0">Employee List</h4>
    </el-card>

    <div class="d-flex">
      <div>
        <el-input
          v-model="filters.keyword"
          clearable
          placeholder="Search Employee..."
          style="width: 250px"
          @keyup.enter.native.prevent="fetchEmployees"
        >
        </el-input>
      </div>

      <div class="ml-auto">
        <el-button type="primary" @click="openDialog('Add Employee')">
          <i class="fas fa-plus"></i> Add Employee
        </el-button>
      </div>
    </div>

    <el-table :data="employees" style="width: 100%">
      <el-table-column prop="name" label="Name"></el-table-column>
      <el-table-column prop="company" label="Company"></el-table-column>
      <el-table-column prop="department" label="Department"></el-table-column>
      <el-table-column
        prop="phone_number"
        label="Phone Number"
      ></el-table-column>
      <el-table-column label="Action">
        <template slot-scope="scope">
          <el-button
            type="text"
            @click="openDialog('Edit Employee', scope.row)"
          >
            Edit
          </el-button>
          <el-button type="text" @click="deleteEmployee(scope.row.id)">
            Delete
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <employee-dialog ref="employeeDialog" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import EmployeeDialog from "./EmployeeDialog.vue";

export default {
  components: {
    EmployeeDialog,
  },
  data() {
    return {
      filters: {},
    };
  },

  computed: {
    ...mapGetters("Employee", ["employees"]),
  },

  mounted() {
    this.fetchEmployees({ size: 500 });
  },

  methods: {
    ...mapActions("Employee", [
      "fetchEmployees",
      "fetchEmployee",
      "saveEmployee",
      "updateEmployee",
      "deleteEmployee",
    ]),

    openDialog(title, employee) {
      this.$refs.employeeDialog.openDialog(title, employee);
    },
  },
};
</script>

<style>
</style>
