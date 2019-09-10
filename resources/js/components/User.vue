<template>
  <div>
    <h1>{{ $route.params.id }}</h1>
    {{ this.user }}
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
    axios
      .get('/api/users/' + this.$route.params.id)
      .then(response => (this.user = response.data));
    console.log(this.user);
  }
};
</script>
