<template>
  <table border="1" style="border-collapse: collapse">
    <DBTableHeader :headers="headers" />
    <DBTableBody :items="items" :items-per-page="itemsPerPage" />
  </table>
</template>

<script>
import DBTableHeader from "./DBTableHeader.vue";
import DBTableBody from "./DBTableBody.vue";

export default {
  name: "db-table",
  components: {
    DBTableHeader,
    DBTableBody
  },
  props: {
    headers: {
      type:Array,
      required: true
    },
    items: {
      type: Array,
      required: true
    },
    itemsPerPage: {
      type: Number,
      default: 30
    }
  }
}
</script>

<style scoped>
table {
  display: block;
  overflow-x: scroll;
  white-space: nowrap;
}
</style>
