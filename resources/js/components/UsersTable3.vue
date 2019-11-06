<template>
  <div>
    <h3>Users Table</h3>
    <SearchForm url="/api/userColumns" />
    <DBTableForLaravelPagination :url="url" />
  </div>
</template>

<script>
import DBTableForLaravelPagination from "./DBTableForLaravel/DBTableForLaravelPagination.vue";
import SearchForm from "./DBTableForLaravel/SearchForm.vue";

export default {
  name: "users-table",
  components: {
    DBTableForLaravelPagination,
    SearchForm
  },
  data: function() {
    return {
      url: "/api/users"
    }
  }
};
</script>
