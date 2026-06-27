const Login = {
    emits: ['auth-changed'],
    data() { return { email: 'admin@example.com', password: 'admin123', error: '', loading: false }; },
    methods: {
        async submit() {
            this.loading = true; this.error = '';
            try {
                const response = await axios.post(API_BASE + '/api/auth/login', { email: this.email, password: this.password });
                localStorage.setItem('token', response.data.token);
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.setItem('user', JSON.stringify(response.data.user));
                this.$emit('auth-changed');
                this.$router.push('/artikel');
            } catch (error) {
                this.error = 'Login gagal. Periksa email dan password.';
            } finally { this.loading = false; }
        },
    },
    template: '<section class="panel"><h2>Login</h2><form @submit.prevent="submit"><label>Email</label><input type="email" v-model="email" required><label>Password</label><input type="password" v-model="password" required><button class="btn" type="submit" :disabled="loading">{{ loading ? "Memproses..." : "Login" }}</button><p class="error" v-if="error">{{ error }}</p></form></section>',
};
