import { createRouter, createWebHistory } from 'vue-router'
import AppMain from "@/views/AppMain";

const routes = [
  // {
  //   path: '/',
  //   name: 'Home',
  //   component: Home
  // },
  // {
  //   path: '/about',
  //   name: 'About',
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: function () {
  //     return import(/* webpackChunkName: "about" */ '../views/About.vue')
  //   }
  // }
  {
    path: '/',
    name: 'mainEntrance',
    component: AppMain,
    children: [
      {
        path: 'standard_demo',
        name: 'standard_demo',
        component: () => import('@/views/standard_demostrate')
      },
      {
        path: 'sql_custom_query',
        name: 'sql_custom_query',
        component: () => import('@/views/sql_query_center')
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
