<template>
  <tbody>
    <template v-for="item in itemsPerPage">
      <tr @click="$router.push({ path: `user/${item.id}`})">
        <template v-for="field in item">
          <td :align="typeof field == 'number' ? 'right' : 'left'">{{ field }}</td>
        </template>
      </tr>
    </template>
  </tbody>
</template>

<script>
export default {
  name: "db-table-body",
  props: {
    items: {
      type: Array,
      required: true
    },
    rowsPerPage: {
      type: Number,
      required: true
    },
    pageOffset: {
      type: Number,
      required: true
    }
  },
  computed: {
    itemsPerPage: function() {
      const startIndex = (this.$props.pageOffset - 1) * this.$props.rowsPerPage;
      const endIndex = Math.min(startIndex + this.$props.rowsPerPage, this.$props.items.length);
      return this.$props.items.slice(startIndex, endIndex);
    }
  }
};
</script>

<style scoped>
tr:hover {
  background: skyblue;
}
</style>
