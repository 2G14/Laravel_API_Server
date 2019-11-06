<template>
  <div>
    <h3>Users Table</h3>
    <DBTable url="/api/userColumns" />
  </div>
</template>

<script>
import DBTable from "./DBTableForLaravel/DBTable.vue";

export default {
  name: "users-table",
  components: {
    DBTable,
  },
  data: function() {
    return {
      url: "/api/users"
    }
  }
};
</script>
