<template>
  <div id="app">
    <navbar></navbar>
    <div class="mt-5">
      <router-view />
    </div>
  </div>
</template>

<script>
import Navbar from "./components/Navbar.vue";
export default {
  components: {
    Navbar,
  },
};
</script>
