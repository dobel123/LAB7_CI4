const Artikel = {
    data() {
        return { artikel: [], form: { id: null, judul: '', isi: '', status: 1, id_kategori: 1, gambar: 'default.jpg' }, q: '', sort: 'created_at', page: 1, pageCount: 1, loading: false, error: '' };
    },
    mounted() { this.loadData(); },
    methods: {
        async loadData(page = 1) {
            this.loading = true; this.error = ''; this.page = page;
            try {
                const response = await axios.get(API_BASE + '/post', { params: { q: this.q, sort: this.sort, page, perPage: 5 } });
                this.artikel = response.data.data;
                this.pageCount = response.data.pager.pageCount || 1;
            } catch (error) { this.error = 'Data artikel gagal dimuat.'; }
            finally { this.loading = false; }
        },
        edit(row) { this.form = { ...row }; },
        resetForm() { this.form = { id: null, judul: '', isi: '', status: 1, id_kategori: 1, gambar: 'default.jpg' }; },
        async save() {
            const payload = { judul: this.form.judul, isi: this.form.isi, status: Number(this.form.status), id_kategori: Number(this.form.id_kategori), gambar: this.form.gambar || 'default.jpg' };
            if (this.form.id) await axios.put(API_BASE + '/post/' + this.form.id, payload);
            else await axios.post(API_BASE + '/post', payload);
            this.resetForm(); this.loadData(this.page);
        },
        async remove(row) {
            if (!confirm('Hapus artikel "' + row.judul + '"?')) return;
            await axios.delete(API_BASE + '/post/' + row.id);
            this.loadData(this.page);
        },
    },
    template: '<section><div class="panel"><h2>Kelola Artikel</h2><div class="toolbar"><input type="search" v-model="q" @input="loadData(1)" placeholder="Cari artikel"><select v-model="sort" @change="loadData(1)"><option value="created_at">Tanggal</option><option value="judul">Judul</option></select><button class="btn" type="button" @click="loadData(1)">Muat</button></div><div class="loading" v-if="loading">Mengambil data...</div><p class="error" v-if="error">{{ error }}</p><table v-if="!loading"><thead><tr><th>Judul</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr></thead><tbody><tr v-for="row in artikel" :key="row.id"><td>{{ row.judul }}</td><td>{{ row.nama_kategori || "-" }}</td><td>{{ Number(row.status) === 1 ? "Publik" : "Draft" }}</td><td class="actions"><button class="btn" type="button" @click="edit(row)">Ubah</button><button class="btn" type="button" @click="remove(row)">Hapus</button></td></tr></tbody></table><div class="actions"><button class="btn" type="button" :disabled="page <= 1" @click="loadData(page - 1)">Prev</button><span>Halaman {{ page }} / {{ pageCount }}</span><button class="btn" type="button" :disabled="page >= pageCount" @click="loadData(page + 1)">Next</button></div></div><form class="panel" @submit.prevent="save"><h3>{{ form.id ? "Ubah Artikel" : "Tambah Artikel" }}</h3><label>Judul</label><input type="text" v-model="form.judul" required><label>Kategori</label><select v-model="form.id_kategori"><option value="1">Pemrograman</option><option value="2">Web</option><option value="3">Database</option></select><label>Isi</label><textarea rows="5" v-model="form.isi" required></textarea><label>Status</label><select v-model="form.status"><option value="1">Publik</option><option value="0">Draft</option></select><div class="actions"><button class="btn" type="submit">Simpan</button><button class="btn" type="button" @click="resetForm">Batal</button></div></form></section>',
};
