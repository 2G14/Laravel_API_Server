<template>
  <div>
    <table border="1" style="border-collapse: collapse">
      <DBTableHeader :headers="headers" />
      <DBTableBody :items="items" :rows-per-page="rowsPerPage" :pageOffset="page_offset" />
    </table>
    <div class="pagination">
      <button v-show="page_offset > 1" type="button" @click="movePages(-1)">←</button>
      {{ page_offset }} ／ {{ max_pages }}
      <button v-show="page_offset < max_pages" type="button" @click="movePages(1)">→</button>
    </div>
  </div>
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
    rowsPerPage: {
      type: Number,
      default: 30
    }
  },
  data: function() {
    return {
      page_offset: 1
    };
  },
  computed: {
    max_pages: function() {
      return Math.ceil(this.$props.items.length / this.$props.rowsPerPage);
    }
  },
  methods: {
    movePages: function(amount) {
      this.page_offset += amount;
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
.pagination {
  width: 100vw;
  text-align: center;
  display: inline-block;
}
</style>
