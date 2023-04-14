import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import DetailView from '../views/DetailView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import UserView from '../views/UserView.vue'
import AdminView from '../views/AdminView.vue'
import PostCreate from '../components/EmailConfirmation.vue'
import EditPost from '../components/EditPost'
import EditComment from '../components/EditComment'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/detail/:id',
    name: 'detail',
    component: DetailView
  },
  {
    path: '/editpost/:id',
    name: 'editpost',
    component: EditPost
  },
  {
    path: '/editcomment/:id',
    name: 'editcomment',
    component: EditComment
  },
  {
    path: '/create',
    name: 'create',
    component: PostCreate
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView
  },
  {
    path: '/user',
    name: 'user',
    component: UserView
  },
  {
    path: '/admin',
    name: 'admin',
    component: AdminView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
