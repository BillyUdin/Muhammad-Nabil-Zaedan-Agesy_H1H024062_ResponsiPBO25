Nama        :Muhammad Nabil Zaeddan Agesy 
NIM         :H1H024062
Shift baru  :C

# 🎮 Pokémon Research & Training Center (PRTC)
## Sistem Simulasi Pelatihan Pokémon - Zubat Edition
---

## 📖 Deskripsi

Aplikasi web berbasis PHP dengan konsep **Object-Oriented Programming (OOP)** untuk mensimulasikan sistem pelatihan Pokémon. Dibuat khusus untuk **Pokémon Research & Training Center (PRTC)** dengan fokus pada Pokémon **Zubat** (Tipe: Poison/Flying).

Aplikasi ini **TIDAK memerlukan**:
- ❌ XAMPP
- ❌ Laragon
- ❌ MySQL/MariaDB
- ❌ PHPMyAdmin

Cukup gunakan **PHP Built-in Server** via CMD!

---

## ✨ Fitur Utama

### 🏠 1. Halaman Beranda (`index.php`)
- ✅ Menampilkan informasi dasar Pokémon (Nama, Tipe, Level, HP)
- ✅ Menampilkan jurus spesial Zubat
- ✅ Navigasi ke halaman Latihan dan Riwayat

### 🏋️ 2. Halaman Latihan (`training.php`)
- ✅ Form pemilihan jenis latihan:
  - ⚔️ **Attack Training** - Meningkatkan kekuatan serangan
  - 🛡️ **Defense Training** - Meningkatkan pertahanan
  - ⚡ **Speed Training** - Meningkatkan kecepatan
- ✅ Input intensitas latihan (1-100)
- ✅ Sistem peningkatan Level & HP berdasarkan intensitas
- ✅ Bonus khusus untuk tipe Poison/Flying:
  - Speed Training: Bonus +1 Level (Flying type)
  - Attack Training: Bonus Poison damage +3
- ✅ Menampilkan hasil latihan secara real-time

### 📊 3. Halaman Riwayat (`history.php`)
- ✅ Ringkasan statistik (Total sesi, Level, HP)
- ✅ Daftar lengkap semua sesi latihan
- ✅ Detail setiap sesi:
  - Jenis latihan
  - Intensitas
  - Perubahan Level (sebelum & sesudah)
  - Perubahan HP (sebelum & sesudah)
  - Timestamp (waktu latihan)
  - Bonus yang didapat

---

## 📂 Struktur Folder

```
Pokemon-Zubat/
│
├── classes/                      # Folder untuk Class OOP
│   ├── Pokemon.php              # Abstract class Pokemon & class Zubat
│   └── Zubat.php                # (Opsional - sudah include di Pokemon.php)
│
├── Assests/                     # Folder untuk Asset
│   └── style.css                # File CSS untuk styling
│
├── index.php                    # Halaman Beranda
├── training.php                 # Halaman Latihan
├── history.php                  # Halaman Riwayat Latihan
├── process_training.php         # (Opsional - proses di training.php)
├── servertest.php               # Test server PHP
├── test.php                     # Test class Pokemon
│
└── README.md                    # Dokumentasi ini
```

---

## 🚀 Cara Menjalankan

### Persyaratan
- PHP 7.4 atau lebih baru
- Web browser (Chrome, Firefox, Edge, dll)
- Command Prompt (CMD)

### Langkah-langkah

#### 1️⃣ Cek PHP Terinstal
```bash
php -v
```
Jika muncul versi PHP, Anda siap melanjutkan!

#### 2️⃣ Buka Command Prompt (CMD)
- Tekan `Windows + R`
- Ketik `cmd`
- Tekan Enter

#### 3️⃣ Masuk ke Folder Project
```bash
cd "D:\Project praktikum PBO\Pokemon-Zubat"
```

#### 4️⃣ Jalankan server dari folder project
- php -S 127.0.0.1:8000
```


## 🎯 Cara Penggunaan

### Halaman Beranda
1. Lihat informasi Zubat (Level awal: 5, HP awal: 40)
2. Lihat jurus spesial yang dimiliki Zubat
3. Klik "Mulai Latihan" untuk melatih Pokémon

### Halaman Latihan
1. Pilih jenis latihan dari dropdown:
   - Attack Training
   - Defense Training  
   - Speed Training (Rekomendasi untuk Zubat - dapat bonus!)
2. Masukkan intensitas (1-10)
   - 1 = +1 Level, +3 HP
   - 5 = +7Level, +15 HP
   - 10 = +15 Level, +30 HP
3. Klik "Mulai Latihan"
4. Lihat hasil training dan bonus yang didapat

### Halaman Riwayat
1. Lihat total sesi latihan yang telah dilakukan
2. Lihat Level dan HP saat ini
3. Review detail setiap sesi latihan dengan timestamp

---

## 🛑 Menghentikan Server

Di jendela CMD, tekan:
```
Ctrl + C
```

---

## 💻 Konsep OOP yang Digunakan

### 1. **Abstraction**
```php
abstract class Pokemon {
    abstract public function specialMove();
}
```

### 2. **Inheritance**
```php
class Zubat extends Pokemon {
    // Zubat mewarisi properties & methods dari Pokemon
}
```

### 3. **Encapsulation**
```php
protected $name;
protected $level;

public function getName() {
    return $this->name;
}
```

### 4. **Polymorphism**
```php
// Override method train() di Zubat
public function train($trainingType, $intensity) {
    $result = parent::train($trainingType, $intensity);
    // Tambahkan bonus khusus untuk Zubat
}
```

## 📊 Data & Session Management

- Data disimpan dalam **PHP Session**
- Data bersifat **temporary** (hilang jika browser ditutup)
- Tidak memerlukan database
- Cocok untuk simulasi dan pembelajaran

**Reset Data:**
- Tutup browser
- Buka browser dalam mode Incognito/Private
- Atau clear cookies browser

---

## 🎓 Tujuan Pembelajaran

Aplikasi ini dibuat untuk memahami:
1. ✅ Konsep OOP dalam PHP (Class, Inheritance, Abstraction)
2. ✅ Session Management
3. ✅ Form Processing
4. ✅ MVC Pattern (sederhana)
5. ✅ Web Development tanpa framework

---

## 🦇 Tentang Zubat

**Nama:** Zubat  
**Tipe:** Poison/Flying  
**Level Awal:** 5  
**HP Awal:** 40

**Jurus Spesial:**
- 🩸 **Leech Life** - Menyerap HP lawan sebesar 80 damage
- 🔊 **Supersonic** - Membingungkan lawan dengan gelombang suara
- 🪽 **Wing Attack** - Serangan menggunakan sayap dengan power 60
- 🐍 **Poison Fang** - Gigitan beracun yang dapat meracuni lawan

**Keunggulan:**
- Mendapat bonus saat Speed Training (+1 Level)
- Mendapat bonus saat Attack Training (+3 Poison damage)

---

## 👨‍💻 Developer

Created for: **Pokémon Research & Training Center (PRTC)**  
Purpose: Educational & Training Simulation  
Tech Stack: PHP (Native), HTML5, CSS3  
Paradigm: Object-Oriented Programming (OOP)

---

## 📝 Lisensi

Proyek ini dibuat untuk keperluan **edukasi** dan **pembelajaran**.

---

## 🎉 Selamat Berlatih!

Good luck, Trainer! Latih Zubat Anda menjadi lebih kuat! ⚡🦇

**Jangan lupa:** Semakin tinggi intensitas latihan, semakin besar peningkatan kemampuan Pokémon Anda!

---

**Version:** 1.0.0  
**Last Updated:** 2024  
**Status:** ✅ Stable & Ready to Use    

<!-- Failed to upload "Video PBO.gif.gif" -->
