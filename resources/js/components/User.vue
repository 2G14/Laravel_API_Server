<template>
  <div>
    <template v-for="(value, key) in user">
      <div>{{ key }} : {{ value }}</div>
    </template>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "user",
  data: function() {
    return {
      user: null
    };
  },
  mounted () {
    axios.get('/api/users/' + this.$route.params.id).then(response => (this.user = response.data));
  }
};
</script>
