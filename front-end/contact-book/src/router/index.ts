import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ContactTable from '../views/Contact/ContactTable.vue';
import LoginForm from '@/views/Login/LoginView.vue';
import RegisterForm from '@/views/Login/RegisterView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path: '/',
    //   name: 'home',
    //   component: HomeView
    // },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/contact',
      name: 'contact',
      component: ContactTable,
      meta: {
        requiresAuth: true, // Adicione esta meta para rotas que requerem autenticação
      },
    },

    {
      path: '/',
      name: 'login',
      component: LoginForm
    },

    {
      path: '/register',
      name: 'register',
      component: RegisterForm
    }
  ],
  
})

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!token) {
      // Redireciona para a página de login se não estiver autenticado
      next({ name: 'login' }); // Certifique-se de que o nome da rota está em minúsculas
    } else {
      next();
    }
  } else if (to.name === 'login' && token) {
    // Redireciona para a página de contato se já estiver autenticado
    next({ name: 'contact' });
  } else {
    next();
  }
});

export default router
