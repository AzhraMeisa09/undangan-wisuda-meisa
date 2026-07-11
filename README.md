# 🎓 Undangan Wisuda Premium — Nadia Deari Hanifah

## Struktur File

```
Undangan Wisuda/
├── index.html        ← Halaman utama (buka ini di browser)
├── api.php           ← API guestbook (butuh PHP server)
├── config.php        ← Konfigurasi database MySQL
├── database.sql      ← Script buat database
└── music/            ← Folder audio (buat manual)
    ├── canon_in_d.mp3
    ├── a_thousand_years.mp3
    ├── enchanted.mp3
    └── perfect.mp3
```

---

## ⚡ Cara Setup (XAMPP/Laragon)

### 1. Pindahkan folder ke htdocs
Copy folder **"Undangan Wisuda"** ke:
- XAMPP: `C:\xampp\htdocs\undangan-wisuda\`
- Laragon: `C:\laragon\www\undangan-wisuda\`

### 2. Buat Database MySQL
Buka **phpMyAdmin** → pilih tab **SQL** → paste & jalankan isi file `database.sql`

### 3. Sesuaikan config.php (jika perlu)
Buka `config.php`, ubah `DB_USER` dan `DB_PASS` sesuai MySQL kamu.
Default XAMPP: user=`root`, pass=`(kosong)`

### 4. Buka di browser
```
http://localhost/undangan-wisuda/index.html
```

---

## 🔗 Cara Kirim Undangan dengan Nama Tamu

Cukup tambahkan `?to=NamaTamu` di URL:

```
http://localhost/undangan-wisuda/?to=Andi%20Saputra
http://localhost/undangan-wisuda/?to=Budi%20Santoso
```

Nama akan muncul otomatis di bagian **"Dear, [Nama Tamu]"**

---

## 🗑️ Hapus Pesan (Admin)

Akses via URL:
```
DELETE http://localhost/undangan-wisuda/api.php?action=delete&id=[ID]&key=nadia2026
```

Atau ganti password admin di `api.php` baris:
```php
if ($adminKey !== 'nadia2026') {
```

---

## 🎵 Musik

1. Buat folder `music/` di dalam folder proyek
2. Masukkan file audio:
   - `canon_in_d.mp3`
   - `a_thousand_years.mp3`
   - `enchanted.mp3`
   - `perfect.mp3`

Download bebas dari: [pixabay.com/music](https://pixabay.com/music/) (gratis, bebas hak cipta)

---

## 📱 Fitur

- ✅ Nama tamu otomatis dari URL
- ✅ Countdown realtime ke 12 Juli 2026
- ✅ Gallery dengan filter & lightbox
- ✅ Timeline perjalanan kuliah
- ✅ Buku Tamu dengan database MySQL
- ✅ Floating music player
- ✅ Partikel sakura & glitter
- ✅ Cursor glow custom
- ✅ Animasi scroll reveal
- ✅ Responsive mobile
- ✅ Glassmorphism design
