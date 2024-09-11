import { createRouter, createWebHistory } from 'vue-router'
import HomeView from "@/views/HomeView.vue";
import AdvertismentViewCard from "@/components/AdvertismentViewCard.vue";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/create',
      name: 'create',
      component: () => import('@/views/CreateView.vue')
    },
    { path: '/advertisement/:id', component: AdvertismentViewCard },
  ]
})

export default router
