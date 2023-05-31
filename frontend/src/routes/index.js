import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import LinkShortener from '../views/LinkShortener.vue'
import EditLink from '../views/EditLink.vue'
import NotFound from '../views/NotFound.vue'

const routes = [
  { path: '/', component: Home },
  { path: '/:id', component: LinkShortener },
  { path: '/edit/link/:id', component: EditLink },
  { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound },
]

const router = createRouter({
  history: createWebHistory(),
  routes, 
})

export default router