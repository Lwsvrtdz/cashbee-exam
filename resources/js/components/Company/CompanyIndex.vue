<template>
  <div>
    <el-card class="box-card mb-5">
      <h4 class="mb-0">Company List</h4>
    </el-card>

    <div class="d-flex">
      <div>
        <el-input
          v-model="filters.keyword"
          clearable
          placeholder="Search Company..."
          style="width: 250px"
          @keyup.enter.native.prevent="fetchCompanies"
        >
        </el-input>
      </div>

      <div class="ml-auto">
        <el-button type="primary" @click="openDialog('Add Company')">
          <i class="fas fa-plus"></i> Add Company
        </el-button>
      </div>
    </div>

    <el-table :data="companies" style="width: 100%">
      <el-table-column prop="name" label="Name"></el-table-column>
      <el-table-column prop="description" label="Description"></el-table-column>
      <el-table-column label="Action">
        <template slot-scope="scope">
          <el-button type="text" @click="openDialog('Edit Company', scope.row)">
            Edit
          </el-button>
          <el-button type="text" @click="deleteCompany(scope.row.id)">
            Delete
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <company-dialog ref="companyDialog" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import CompanyDialog from "./CompanyDialog.vue";

export default {
  components: {
    CompanyDialog,
  },
  data() {
    return {
      filters: {},
    };
  },

  computed: {
    ...mapGetters("Company", ["companies"]),
  },

  mounted() {
    this.fetchCompanies({ size: 500 });
  },

  methods: {
    ...mapActions("Company", [
      "fetchCompanies",
      "fetchCompany",
      "saveCompany",
      "updateCompany",
      "deleteCompany",
    ]),

    openDialog(title, company) {
      this.$refs.companyDialog.openDialog(title, company);
    },
  },
};
</script>

<style>
</style>
