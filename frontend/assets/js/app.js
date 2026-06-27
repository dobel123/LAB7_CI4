const API_BASE = 'http://localhost/labci4/public';

axios.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = 'Bearer ' + token;
    }
    return config;
});

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/artikel', component: Artikel, meta: { requiresAuth: true } },
    { path: '/about', component: About, meta: { requiresAuth: true } },
];

const router = VueRouter.createRouter({ history: VueRouter.createWebHashHistory(), routes });

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('isLoggedIn') === 'true';
    if (to.meta.requiresAuth && !loggedIn) {
        alert('Silakan login terlebih dahulu.');
        next('/login');
        return;
    }
    next();
});

const app = Vue.createApp({
    data() { return { isLoggedIn: localStorage.getItem('isLoggedIn') === 'true' }; },
    methods: {
        refreshAuth() { this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true'; },
        logout() {
            if (!confirm('Apakah Anda yakin ingin keluar aplikasi?')) return;
            axios.post(API_BASE + '/api/auth/logout').finally(() => {
                localStorage.clear();
                this.refreshAuth();
                this.$router.push('/');
            });
        },
    },
});
app.use(router);
app.mount('#app');
