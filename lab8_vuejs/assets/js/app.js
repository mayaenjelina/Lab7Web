const { createApp } = Vue;
const { createRouter, createWebHashHistory } = VueRouter;

const apiUrl = 'http://localhost/lab11_php_ci/ci4/public';

// =============================================
// AXIOS INTERCEPTORS — Penyuntik Token Otomatis
// =============================================

// Request interceptor — tambah token ke setiap request
axios.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('userToken');
    if (token) {
      config.headers['Authorization'] = 'Bearer ' + token;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

// Response interceptor — tangkap error 401 global
axios.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 401) {
      alert('Sesi Anda telah berakhir atau Token tidak sah. Silakan login kembali.');
      localStorage.clear();
      window.location.href = '#/login';
      window.location.reload();
    }
    return Promise.reject(error);
  }
);

// =============================================
// ROUTES
// =============================================
const routes = [
  { path: '/', component: Home },
  { path: '/login', component: Login },
  { 
    path: '/artikel', 
    component: Artikel,
    meta: { requiresAuth: true }
  },
  {
    path: '/about',
    component: About,
    meta: { requiresAuth: true }
  }
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

// Navigation Guards
router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('isLoggedIn') === 'true';
  if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
    alert('Akses Ditolak! Anda harus login terlebih dahulu.');
    next('/login');
  } else {
    next();
  }
});

// =============================================
// ROOT APP
// =============================================
const app = createApp({
  template: `
    <div>
      <header>
        <h1>Aplikasi Panel Single Page (SPA) - Secured</h1>
        <nav class="nav-menu">
          <router-link to="/">Beranda</router-link> |
          <router-link to="/artikel">Kelola Artikel</router-link> |
          <router-link to="/about">About</router-link> |
          <router-link v-if="!isLoggedIn" to="/login">Login</router-link>
          <a v-else href="#" @click.prevent="logout">Logout</a>
        </nav>
      </header>
      <main style="margin-top: 20px;">
        <router-view></router-view>
      </main>
    </div>
  `,
  data() {
    return {
      isLoggedIn: false
    }
  },
  mounted() {
    this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
  },
  methods: {
    logout() {
      if (confirm('Apakah Anda yakin ingin keluar aplikasi?')) {
        localStorage.clear();
        this.isLoggedIn = false;
        this.$router.push('/');
      }
    }
  }
});

app.use(router);
app.mount('#app');