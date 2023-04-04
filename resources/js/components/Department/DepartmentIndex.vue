<template>
  <div>
    <el-card class="box-card mb-5">
      <h4 class="mb-0">Department List</h4>
    </el-card>

    <div class="d-flex">
      <div>
        <el-input
          v-model="filters.keyword"
          clearable
          placeholder="Search Department..."
          style="width: 250px"
          @keyup.enter.native.prevent="fetchDepartments"
        >
        </el-input>
      </div>

      <div class="ml-auto">
        <el-button type="primary" @click="openDialog('Add Department')">
          <i class="fas fa-plus"></i> Add Department
        </el-button>
      </div>
    </div>

    <el-table :data="departments" style="width: 100%">
      <el-table-column prop="name" label="Name"></el-table-column>
      <el-table-column prop="description" label="Description"></el-table-column>
      <el-table-column label="Action">
        <template slot-scope="scope">
          <el-button
            type="text"
            @click="openDialog('Edit Department', scope.row)"
          >
            Edit
          </el-button>
          <el-button type="text" @click="deleteDepartment(scope.row.id)">
            Delete
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <department-dialog ref="departmentDialog" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import DepartmentDialog from "./DepartmentDialog.vue";

export default {
  components: {
    DepartmentDialog,
  },
  data() {
    return {
      filters: {},
    };
  },

  computed: {
    ...mapGetters("Department", ["departments"]),
  },

  mounted() {
    this.fetchDepartments({ size: 500 });
  },

  methods: {
    ...mapActions("Department", [
      "fetchDepartments",
      "fetchDepartment",
      "saveDepartment",
      "updateDepartment",
      "deleteDepartment",
    ]),

    openDialog(title, department) {
      this.$refs.departmentDialog.openDialog(title, department);
    },
  },
};
</script>

<style>
</style>
