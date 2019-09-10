import Vue from "vue";
import Router from "vue-router";
import Login from "./../components/Login.vue";
import UsersTable from "./../components/UsersTable.vue";
import User from "./../components/User.vue"

Vue.use(Router);

export default new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/login",
      component: Login
    },
    {
      path: "/users",
      component: UsersTable
    },
    {
      path: "/user/:id",
      component: User
    },
//    {
//      path: "*",
//      redirect: "/login"
//    },
  ]
})
