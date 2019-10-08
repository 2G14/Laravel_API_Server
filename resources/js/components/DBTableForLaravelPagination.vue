<template>
  <div>
    <h5>{{ total }} 中 {{ from }} から {{ to }} までを表示中</h5>
    <table border="1" style="border-collapse: collapse">
      <thead>
        <tr>
          <template v-for="header in headers">
            <td>{{ header.text }}</td>
          </template>
        </tr>
      </thead>
      <tbody>
        <template v-for="item in items">
          <tr class="tbody-row" @click="$router.push({ path: `user/${item.id}`})">
            <template v-for="field in item">
              <td :align="typeof field == 'number' ? 'right' : 'left'">{{ field }}</td>
            </template>
          </tr>
        </template>
      </tbody>
    </table>
    <div class="pagination">
      <button v-show="current_page > 1" type="button" @click="movePage(-1)">←</button>
      {{ current_page }} ／ {{ last_page }}
      <button v-show="current_page < last_page" type="button" @click="movePage(1)">→</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "db-table-for-laravel-pagination",
  props: {
    url: {
      type: String,
      required: true
    }
  },
  data: function() {
    return {
      headers: [],
      items: [],
      current_page: 0,
      last_page: 0,
      per_page: 0,
      total: 0
    };
  },
  computed: {
    from: function() {
      return (this.current_page - 1) * this.per_page + 1;
    },
    to: function() {
      return Math.min(this.current_page * this.per_page, this.total);
    }
  },
  mounted: function() {
    this.request(1);
  },
  methods: {
    movePage: function(amount) {
      this.request(this.current_page + amount);
    },
    request: function(page) {
      axios.get(this.$props.url + '?page=' + page).then(response => {
        response = response.data;
        this.items = response.data;
        this.headers = [];
        const keys = Object.keys(this.items[0]);
        for (const key of keys)
          this.headers.push({text: key, value: key});
        this.current_page = response.current_page;
        this.last_page = response.last_page;
        this.per_page = response.per_page;
        this.total = response.total;
      }).catch(error => {
        console.log(`Error ${error}`);
      });
    },
  }
};
</script>

<style scoped>
table {
  display: block;
  overflow-x: scroll;
  white-space: nowrap;
}
thead {
  font-weight: bold;
  background: lightgray;
}
tr.tbody-row:hover {
  background: skyblue;
}
.pagination {
  width: 100vw;
  text-align: center;
  display: inline-block;
}
</style>
