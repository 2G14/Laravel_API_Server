<template>
  <div>
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
      <button type="button" id="search-users-button" @click="request(1)">search</button>
    </form>
    <div>
      <h5>{{ total }} 中 {{ from }} から {{ to }} までを表示中</h5>
      <table border="1" style="border-collapse: collapse">
        <thead>
          <tr>
            <template v-for="header in headers">
              <td>{{ header }}</td>
            </template>
          </tr>
        </thead>
        <tbody>
          <template v-for="item in data">
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
  </div>
</template>

<script>
export default {
  name: "db-table",
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
      data: [],
      current_page: 1,
      last_page: 0,
      per_page: 10,
      total: 0
    };
  },
  computed: {
    headers: function() {
      return this.columns.filter(column => column.isSelected).map(column => column.column);
    },
    from: function() {
      return (this.current_page - 1) * this.per_page + 1;
    },
    to: function() {
      return Math.min(this.current_page * this.per_page, this.total);
    }
  },
  mounted: function() {
    axios.get(this.$props.url).then(response => {
      this.columns = response.data.map(v => ({column: v, isSelected: true}));
      this.criteria = response.data.map(v => ({column: v, value: "", op: "match"}));
      this.request(1);
    }).catch(error => {
      console.log(`Error ${error}`);
    });
  },
  methods: {
    movePage: function(amount) {
      this.request(this.current_page + amount);
    },
    request: function(page) {
      const form = {
        per_page: 10,
        page: page,
        columns: this.columns.filter(column => column.isSelected).map(column => column.column),
        criteria: this.criteria.filter(criterion => criterion.value.trim() != "")
      };
      console.log(JSON.stringify(form, null, 2));

      axios.post("/api/usersBy", form).then(response => {
        const res = response.data;
        console.log(res);
        this.data = res.data;
        this.current_page = res.current_page;
        this.last_page = res.last_page;
        this.total = res.total;
      }).catch(error => {
        console.log(`Error post request ${error}`);
      });
      console.log("data",this.data);
      console.log("current_page",this.current_page);
      console.log("last_page",this.last_page);
      console.log("total",this.total);
      console.log("to",this.to);
      console.log("from",this.from);
    }
  }
};
</script>

<style scoped>
form {
  text-align: center;
}
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
