# AI Collaborator: Senior Laravel Developer

## Role

Memberikan solusi terbaik, aman, rapi, dan mengikuti best practice Laravel.

## Goal

Membangun aplikasi sosial media sederhana menggunakan Laravel secara bertahap.

## Rules

- Kerjakan SATU modul sampai selesai sebelum lanjut.
- Urutan pengerjaan setiap modul:
  1. Migration
  2. Model
  3. Controller
  4. Route
  5. Blade View
  6. Testing
- Jangan mengubah modul yang sudah selesai kecuali ada bug.
- Gunakan fitur bawaan Laravel jika memungkinkan.
- Ikuti best practice Laravel (Validation, Auth, Eloquent Relationship, Middleware, CSRF Protection).
- Setelah satu modul selesai, buat Checkpoint baru.

---

# Roadmap

- [x] User Registration
- [x] User Login
- [x] Status (Post)
- [x] Feed / Dashboard
- [x] My Posts
- [x] Delete Post
- [ ] Like
- [ ] Comment
- [ ] Edit Post
- [ ] Profile

---

# Checkpoint

## ✅ Modul: User Registration

### Status

SELESAI

### Yang sudah ada

- Registrasi user
- Validasi input
- Password Hash (`bcrypt`)
- Simpan ke PostgreSQL

---

## ✅ Modul: User Login

### Status

SELESAI

### Yang sudah ada

- Form Login
- Authentication menggunakan `Auth::attempt()`
- Session Login berhasil dibuat
- Redirect ke Dashboard
- Validasi email & password
- Menampilkan pesan error jika login gagal

---

## ✅ Modul: Status (Post)

### Status

SELESAI

### Yang sudah ada

- Migration tabel `posts`
- Model `Post`
- Relationship:
  - `User -> hasMany(Post)`
  - `Post -> belongsTo(User)`
- `PostController`
- Route membuat status
- Validasi status
- Simpan status ke PostgreSQL
- Feed global seluruh postingan
- Eager Loading (`with('user')`)
- Urut berdasarkan posting terbaru (`latest()`)

### Struktur tabel `posts`

- id
- user_id
- content
- created_at
- updated_at

### Catatan

- `user_id` otomatis diambil menggunakan `Auth::id()`.
- Output Blade menggunakan `{{ }}` agar aman dari XSS.
- Validasi maksimal 1000 karakter.

---

## ✅ Modul: Feed / Dashboard

### Status

SELESAI

### Yang sudah ada

- Dashboard sebagai halaman utama setelah login
- Feed global seluruh user
- Menampilkan nama pemilik status
- Menampilkan waktu posting (`diffForHumans()`)
- Empty state jika belum ada postingan
- UI Dashboard lebih modern menggunakan Tailwind CSS
- Tombol **Update Status** (toggle form)
- Navbar
- Logout

---

## ✅ Modul: My Posts

### Status

SELESAI

### Yang sudah ada

- Route `posts.mine`
- Menampilkan postingan milik user yang sedang login
- Query berdasarkan `Auth::id()`
- Halaman khusus **My Posts**
- Empty state jika user belum memiliki postingan

---

## ✅ Modul: Delete Post

### Status

SELESAI

### Yang sudah ada

- Route DELETE
- Method `destroy()`
- Hanya pemilik post yang dapat menghapus
- Validasi authorization

```php
if ($post->user_id !== Auth::id()) {
    abort(403);
}
```

- Konfirmasi sebelum menghapus
- Redirect kembali dengan pesan sukses

---

# Target Berikutnya

## ❤️ Like System

Target:

- Migration tabel `likes`
- Relationship
  - User hasMany Likes
  - Post hasMany Likes
- Tombol Like / Unlike
- Setiap user hanya dapat Like satu kali pada satu post
- Menampilkan total Like pada setiap post

---

## 💬 Comment System

Target:

- Migration tabel `comments`
- Relationship
  - User hasMany Comments
  - Post hasMany Comments
- Menambahkan komentar
- Menampilkan daftar komentar
- Menampilkan jumlah komentar
- Hapus komentar milik sendiri

---

# Catatan Pengembangan

Seluruh fitur baru harus mengikuti prinsip:

- Menggunakan Eloquent Relationship
- Validasi Request
- Middleware `auth`
- Authorization (pemilik data)
- CSRF Protection
- Eager Loading untuk menghindari N+1 Query
- Kode tetap sederhana, rapi, dan mudah dikembangkan.