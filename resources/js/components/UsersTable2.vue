<template>
  <div>
    <h3>Users Table</h3>
    <DBTable :headers="headers" :items="users" :items-per-page="10" />
  </div>
</template>

<script>
import axios from "axios";
import DBTable from "./DBTable/DBTable.vue";

export default {
  name: "users-table",
  components: {
    DBTable
  },
  data: function() {
    return {
      headers: [],
      users: []
    };
  },
  mounted: function() {
    axios.get('/api/users').then(response => {
      this.users = response.data;
      const keys = Object.keys(this.users[0]);
      for (const key of keys)
        this.headers.push({text: key, value: key});
    }).catch(error => {
      console.log(`Error ${error}`);
    });
  }
};
</script>
