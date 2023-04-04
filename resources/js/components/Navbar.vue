<template>
  <div>
    <el-menu
      :default-active="activeRoute"
      mode="horizontal"
      @select="handleSelect"
    >
      <el-menu-item index="/sms">SMS</el-menu-item>
      <el-menu-item index="/companies">Companies</el-menu-item>
      <el-menu-item index="/departments">Departments</el-menu-item>
      <el-menu-item index="/employees">Employees</el-menu-item>
    </el-menu>
  </div>
</template>

<script>
export default {
  data() {
    return {
      activeRoute: "/sms",
    };
  },
  methods: {
    handleSelect(index) {
      this.activeRoute = index;
      this.$router.push(index);
    },
  },
  created() {
    this.activeRoute = this.$route.path;
  },

  watch: {
    $route(to, from) {
      this.activeRoute = to.path;
    },
  },
};
</script>
