import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import AdminUsersView from '../views/admin/users/IndexView.vue'
import AdminUserEditView from '../views/admin/users/EditView.vue'
import AdminUserCreateView from '../views/admin/users/CreateView.vue'
import CounterView from '@/views/step5/CounterView.vue'
import AjaxView from '@/views/step6/AjaxView.vue'
import TodoView from '@/views/todo/TodoView.vue'
import TaskView from '../views/TaskView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/admin',
    name: 'admin',
    children: [
      {
        path: 'users',
        name: 'adminUsers',
        component: AdminUsersView
      },
      {
        path: 'users/:id/edit',
        name: 'adminUserEdit',
        component: AdminUserEditView
      },
      {
        path: 'users/create',
        name: 'adminUserCreate',
        component: AdminUserCreateView
      }
    ]
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/task/:id',
    name: 'task',
    component: TaskView,
  },
  {
    path: '/counter',
    component: CounterView,
  },
  {
    path: '/ajax-view',
    component: AjaxView
  },
  {
    path: '/todo',
    component: TodoView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
