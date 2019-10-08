<template>
  <div>
    <h3>Users Table</h3>
    <DBTableForLaravelPagination :url="url" />
  </div>
</template>

<script>
import DBTableForLaravelPagination from "./DBTableForLaravelPagination.vue";

export default {
  name: "users-table",
  components: {
    DBTableForLaravelPagination
  },
  data: function() {
    return {
      url: "/api/users"
    }
  }
};
</script>
