<template>
  <form name="searchUsers" id="search-users">
    <ul>
      <template v-for="column in columns" >
        <li>
          <label>
            <input type="checkbox" v-model="column.isSelected" />
            {{ column.column }}
          </label>
        </li>
      </template>
    </ul>
    <template v-for="criterion in criteria">
      <p>
      {{ criterion.column }}: <input type="text" v-model="criterion.value" />
      <select v-model="criterion.op">
        <option value="match" selected>に一致する</option>
        <option value="contains">を含む</option>
        <option value="startsWith">から始まる</option>
        <option value="endsWith">で終わる</option>
      </select>
      </p>
    </template>
    <button type="button" id="search-users-button" @click="request()">search</button>
  </form>
</template>

<script>
import axios from "axios";

export default {
  name: "search-from",
  props: {
    url: {
      type: String,
      required: true
    }
  },
  data: function() {
    return {
      columns: [],
      criteria: [],
    }
  },
  mounted: function() {
    axios.get(this.$props.url).then(response => {
      this.columns = response.data.map(v => ({column: v, isSelected: true}));
      this.criteria = response.data.map(v => ({column: v, value: "", op: "match"}));
    }).catch(error => {
      console.log(`Error ${error}`);
    });
  },
  methods: {
    request: function() {
      const form = {
        columns: this.columns.filter(column => column.isSelected).map(column => column.column),
        criteria: this.criteria.filter(criterion => criterion.value.trim() != "")
      };
      console.log(JSON.stringify(form, null, 2));
      axios.post("/api/usersBy", form).then(response => {
        console.log(response.data);
      }).catch(error => {
        console.log(`Error post request ${error}`);
      });
    }
  }
};
</script>

<style scoped>
form {
  text-align: center;
}
</style>
