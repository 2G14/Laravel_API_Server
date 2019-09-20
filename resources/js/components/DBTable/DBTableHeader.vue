<template>
  <thead>
    <tr>
      <template v-for="header in headers">
        <td>{{ header.text }}</td>
      </template>
    </tr>
  </thead>
</template>

<script>
export default {
  name: "db-table-header",
  props: {
    headers: {
      type: Array,
      required: true
    }
  }
};
</script>

<style scoped>
thead {
  font-weight: bold;
  background: lightgray;
}
</style>
