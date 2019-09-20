<template>
  <tbody>
    <template v-for="item in itemsOfPage"> 
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
    itemsPerPage: {
      type: Number,
      required: true
    }
  },
  data: function() {
    return {
      page_offset: 1,
    };
  },
  computed: {
    itemsOfPage: function() {
      const startIndex = (this.page_offset - 1) * this.$props.itemsPerPage;
      const endIndex = Math.min(startIndex + this.$props.itemsPerPage, this.$props.items.length);
      return this.items.slice(startIndex, endIndex);
    }
  }
};
</script>

<style scoped>
tr:hover {
  background: skyblue;
}
</style>
