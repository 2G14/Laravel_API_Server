<template>
  <div>
    <h3>Users Table</h3>
    <v-data-table dense :headers="headers" :items="users" multi-sort></v-data-table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "users-table",
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
