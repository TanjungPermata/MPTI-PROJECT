@extends('layouts.utama')

@section('konten')

{{-- ════════════ NAVBAR ════════════ --}}
<nav id="navbar">
  <a href="#home" class="logo">GURAU<span> TENDA & KOST</span></a>
  <ul class="nav-links" id="navLinks">
    <li><a href="#services">Sewa Tenda</a></li>
    <li><a href="#kost">Kost Putri</a></li>
    <li><a href="#reviews">Testimoni</a></li>
    <li><a href="#contact" class="nav-cta">Hubungi Kami</a></li>
  </ul>
  <div style="display:flex;align-items:center;gap:.5rem">
    <button class="btn-admin" id="btnAdminLogin" onclick="bukaLogin()" title="Admin Login">ADMIN</button>
    <button class="btn-admin btn-admin-logout" id="btnAdminLogout" onclick="togglePanel()" style="display:none" title="Buka Panel"><span class="admin-indicator"></span> Panel</button>
    <button class="hamburger" id="hamburger" onclick="toggleMenu()" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

{{-- ════════════ MODAL LOGIN ADMIN ════════════ --}}
<div class="modal-overlay" id="loginModal" onclick="tutupLoginBg(event)">
  <div class="modal-box">
    <button class="modal-close" onclick="tutupLogin()">✕</button>
    <div class="modal-logo">GURAU</div>
    <div class="modal-title">ADMIN LOGIN</div>
    <div class="modal-sub">Masuk untuk mengelola status ketersediaan kost dan history pemesanan tenda.</div>
    <div class="modal-field">
      <label class="modal-label" for="loginUser">Username</label>
      <input class="modal-input" type="text" id="loginUser" placeholder="Masukkan username" autocomplete="off">
    </div>
    <div class="modal-field">
      <label class="modal-label" for="loginPass">Password</label>
      <input class="modal-input" type="password" id="loginPass" placeholder="Masukkan password" onkeydown="if(event.key==='Enter')prosesLogin()">
    </div>
    <div class="modal-error" id="loginError">Username atau Password Salah!</div>
    <button class="modal-btn" onclick="prosesLogin()">LOGIN</button>
  </div>
</div>

{{-- ════════════ PANEL ADMIN ════════════ --}}
<div class="admin-panel" id="adminPanel">
  <div class="admin-panel-header">
    <div class="admin-panel-title">⚙️ Admin Panel</div>
    <button class="admin-panel-close" onclick="togglePanel()">✕</button>
  </div>
  <div class="admin-panel-body">
    <div style="display:flex;gap:.5rem;margin-bottom:1rem">
      <button onclick="gantiTabAdmin('kamar',this)" id="tabKamar"
        style="flex:1;padding:6px;border-radius:6px;border:1px solid rgba(201,168,76,0.3);background:var(--gold);color:var(--dark);font-size:.75rem;cursor:pointer;font-family:'DM Sans',sans-serif;font-weight:500">
        🏠 Status Kamar
      </button>
      <button onclick="gantiTabAdmin('history',this)" id="tabHistory"
        style="flex:1;padding:6px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:transparent;color:var(--muted);font-size:.75rem;cursor:pointer;font-family:'DM Sans',sans-serif">
        📋 History Pesan
      </button>
    </div>
    <div id="panelKamar">
      <div class="admin-section-label">Ketersediaan Per Bulan</div>
      <div id="adminRoomList"></div>
      <button class="admin-save-btn" onclick="simpanDataAdmin()">💾 Simpan Perubahan</button>
      <div class="admin-saved-msg" id="savedMsg">✓ Perubahan berhasil disimpan!</div>
    </div>
    <div id="panelHistory" style="display:none">
      <div class="admin-section-label">History Pemesanan Masuk</div>
      <div id="historyPemesananList">
        <div style="text-align:center;color:var(--muted);padding:1rem;font-size:.85rem">Klik tab untuk memuat data...</div>
      </div>
    </div>
    <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.06);text-align:right">
      <button onclick="adminLogout()" style="background:transparent;border:none;color:rgba(255,59,48,0.7);font-size:.8rem;cursor:pointer;font-family:'DM Sans',sans-serif;padding:4px 8px;border-radius:4px;transition:.2s" onmouseover="this.style.color='#ff6b6b'" onmouseout="this.style.color='rgba(255,59,48,0.7)'">Logout Admin →</button>
    </div>
  </div>
</div>

{{-- ════════════ HERO ════════════ --}}
<header id="home" class="hero">
  <div class="hero-left">
    <div class="hero-badge">★ 4.8 Rating Google · Est. 2004</div>
    <h1>Solusi <em>Tenda</em> &amp; <em>Kost Putri</em> Premium di <em>Palembang</em></h1>
    <p class="hero-sub">Kepercayaan masyarakat Palembang. Dari pernikahan hingga corporate event — semua kami tangani secara profesional.</p>
    <div class="hero-btns">
      <a href="#calculator" class="btn-gold">Hitung Estimasi Harga</a>
      <a href="#contact" class="btn-outline">Hubungi Kami</a>
    </div>
    <div class="stats-row">
      <div class="stat-item"><span class="stat-num" id="c1">0★</span><span class="stat-label">Rating Tenda</span></div>
      <div class="stat-item"><span class="stat-num" id="c2">0★</span><span class="stat-label">Rating Kost</span></div>
      <div class="stat-item"><span class="stat-num" id="c3">0+</span><span class="stat-label">Tahun Berdiri</span></div>
    </div>
  </div>
  <div class="hero-right">
    <a href="#services" class="hero-card">
      <div class="hero-card-label">Layanan Utama</div>
      <h2>Sewa Tenda</h2>
      <p>Pernikahan, Corporate &amp; Pesta</p>
      <div class="hero-card-arrow">→</div>
    </a>
    <a href="#kost" class="hero-card">
      <div class="hero-card-label">Hunian Premium</div>
      <h2>Kost Putri</h2>
      <p>Nyaman, Aman &amp; Strategis</p>
      <div class="hero-card-arrow">→</div>
    </a>
  </div>
</header>

{{-- ════════════ SECTION LAYANAN ════════════ --}}
<section id="services" style="background:var(--dark)">
  <div class="container">
    <div class="section-header-row">
      <div>
        <div class="section-label">Layanan Kami</div>
        <h2 class="section-title">Sewa Tenda &amp; Peralatan Event</h2>
        <p class="section-desc">Peralatan berkualitas untuk setiap momen spesial Anda di Palembang.</p>
      </div>
    </div>
    <div class="services-grid">
      <div class="service-card" data-num="01">
        <div class="service-icon">🏕️</div>
        <h3>Tenda Pernikahan</h3>
        <p>Dekorasi elegan dengan pilihan earth tone atau modern. Setup &amp; teardown oleh tim profesional kami.</p>
      </div>
      <div class="service-card" data-num="02">
        <div class="service-icon">🏢</div>
        <h3>Tenda Corporate / Event</h3>
        <p>Cocok untuk peresmian kantor, pameran, dan acara semi-formal. Tersedia berbagai ukuran.</p>
      </div>
      <div class="service-card" data-num="03">
        <div class="service-icon">🎉</div>
        <h3>Paket Alat Pesta Lengkap</h3>
        <p>Kursi, Panggung, dan Sound System tersedia.</p>
      </div>
    </div>
  </div>
</section>

{{-- ════════════ KALKULATOR HARGA ════════════ --}}
<section id="calculator" class="calculator-section">
  <div class="container">
    <div class="section-header-row">
      <div>
        <div class="section-label">Kalkulator Harga</div>
        <h2 class="section-title">Estimasi Biaya Sewa Tenda</h2>
        <p class="section-desc">Hitung perkiraan biaya event Anda secara instan. Harga final konfirmasi via WhatsApp.</p>
      </div>
    </div>
    <div class="calc-grid">
      <div class="calc-form">

        {{-- 1. Jenis Tenda --}}
        <div class="form-row">
          <label class="form-label" for="tentType">Jenis Tenda</label>
          <select class="form-select" id="tentType" onchange="onTentTypeChange()">
            <option value="biasa">Tenda Biasa — Rp 150.000 / unit</option>
            <option value="semivip">Tenda Semi VIP — Rp 250.000 / unit</option>
            <option value="vip">Tenda VIP — Rp 350.000 / unit</option>
            <option value="balon">Tenda Balon — Rp 850.000 / unit (min. 2 unit)</option>
            <option value="sentris">Tenda Sentris — Rp 600.000 / unit</option>
          </select>
          <div id="balonWarning" style="display:none;font-size:.75rem;color:var(--gold);margin-top:.4rem;padding:6px 10px;background:rgba(201,168,76,0.08);border-radius:6px;border-left:2px solid var(--gold)">
            ⚠ Tenda Balon minimal order 2 unit
          </div>
        </div>

        {{-- 2. Jumlah Unit --}}
        <div class="form-row">
          <label class="form-label">Jumlah Unit Tenda</label>
          <div class="qty-row">
            <button class="qty-btn" onclick="ubahQty('units',-1)">−</button>
            <span class="qty-display" id="unitsDisplay">1</span>
            <button class="qty-btn" onclick="ubahQty('units',1)">+</button>
            <span style="font-size:.85rem;color:var(--muted);margin-left:.25rem">unit</span>
          </div>
        </div>

        {{-- 3. Ukuran Tenda --}}
        <div class="form-row">
          <label class="form-label" for="tentSize">Ukuran Tenda</label>
          <select class="form-select" id="tentSize" onchange="hitungHarga()">
            <option value="kecil">Kecil (3×2 m)</option>
            <option value="sedang">Sedang (4×5 m)</option>
            <option value="besar">Besar (5×5 m)</option>
          </select>
        </div>

        {{-- 4. Warna / Dekor (hanya muncul untuk Biasa, Semi VIP, VIP) --}}
        <div class="form-row" id="warnaRow">
          <label class="form-label" for="tentColor">Warna / Dekor Tenda</label>
          <select class="form-select" id="tentColor" onchange="hitungHarga()"></select>
        </div>

        {{-- 5. Pilihan Kursi --}}
        <div class="form-row">
          <label class="form-label">Pilihan Kursi</label>
          <select class="form-select" id="chairType" onchange="hitungHarga()">
            <option value="none">Tidak Pakai Kursi</option>
            <option value="biasa">Kursi Biasa — Rp 2.000 / pcs</option>
            <option value="cover">Kursi + Cover — Rp 5.000 / pcs</option>
          </select>
        </div>

        {{-- 6. Jumlah Kursi --}}
        <div class="form-row" id="chairQtyRow" style="display:none">
          <label class="form-label">Jumlah Kursi</label>
          <div class="qty-row">
            <button class="qty-btn" onclick="ubahQty('chairs',-10)">−</button>
            <span class="qty-display" id="chairsDisplay">50</span>
            <button class="qty-btn" onclick="ubahQty('chairs',10)">+</button>
            <span style="font-size:.85rem;color:var(--muted);margin-left:.25rem">pcs</span>
          </div>
          <div style="font-size:.75rem;color:var(--muted);margin-top:.4rem">Kelipatan 10 kursi</div>
        </div>

        {{-- 7. Panggung --}}
        <div class="form-row">
          <label class="form-label">Panggung</label>
          <select class="form-select" id="panggungType" onchange="hitungHarga()">
            <option value="none">Tidak Pakai Panggung</option>
            <option value="ada">Panggung 5×5 m — Rp 350.000</option>
          </select>
        </div>

        {{-- 8. Meja --}}
        <div class="form-row">
          <label class="form-label">Pilihan Meja</label>
          <select class="form-select" id="mejaType" onchange="hitungHarga()">
            <option value="none">Tidak Pakai Meja</option>
            <option value="kado">Meja Kado — Rp 100.000 / pcs (include cover)</option>
            <option value="makan">Meja Makan — Rp 150.000 / pcs (include cover)</option>
          </select>
        </div>

        {{-- 9. Jumlah Meja --}}
        <div class="form-row" id="mejaQtyRow" style="display:none">
          <label class="form-label">Jumlah Meja</label>
          <div class="qty-row">
            <button class="qty-btn" onclick="ubahQty('meja',-1)">−</button>
            <span class="qty-display" id="mejaDisplay">1</span>
            <button class="qty-btn" onclick="ubahQty('meja',1)">+</button>
            <span style="font-size:.85rem;color:var(--muted);margin-left:.25rem">pcs</span>
          </div>
        </div>

      </div>

      <div>
        <div class="calc-result">
          <div class="result-label">Estimasi Harga</div>
          <div class="result-price" id="totalPrice">Rp 150.000</div>
          <div class="result-note">* Harga Perkiraan. Konfirmasi &amp; Negosiasi Via WhatsApp Untuk Harga Terbaik.</div>
          <div class="price-breakdown" id="breakdown"></div>
          <button onclick="konfirmasiPesan()" class="wa-btn wa-btn-full" style="border:none;cursor:pointer;">
            💬 Konfirmasi via WhatsApp
          </button>
        </div>
        <div class="included-box">
          <div style="font-size:.8rem;color:var(--muted);text-transform:uppercase;letter-spacing:.5px">Sudah termasuk</div>
          <div class="included-grid">
            <div class="included-item">✓ Pengiriman &amp; Setup</div>
            <div class="included-item">✓ Tim Pemasangan</div>
            <div class="included-item">✓ Bongkar Setelah Acara</div>
            <div class="included-item">✓ Konsultasi Gratis</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ════════════ SECTION KOST ════════════ --}}
<section id="kost" style="background:var(--dark)">
  <div class="container">
    <div class="kost-grid">
      <div>
        <div class="section-label">Hunian Premium</div>
        <h2 class="section-title">Kost Putri Lorok Pakjo</h2>
        <p style="color:var(--muted);font-size:.9rem;line-height:1.7;margin-bottom:1.5rem">Hunian nyaman dan aman untuk perempuan di lokasi strategis Palembang. Dekat dengan kampus dan pusat kota.</p>
        <div class="price-tag">
          <span class="price-from">Mulai dari</span>
          <span class="price-amount">Rp 10.000.000</span>
          <span class="price-from">/ Tahun</span>
        </div>
        <div class="facilities-grid">
          <div class="facility-item"><span style="width:24px;text-align:center">📶</span> WiFi Kecepatan Tinggi</div>
          <div class="facility-item"><span style="width:24px;text-align:center">🔒</span> Keamanan 24 Jam &amp; CCTV</div>
          <div class="facility-item"><span style="width:24px;text-align:center">🚗</span> Parkir Luas</div>
          <div class="facility-item"><span style="width:24px;text-align:center">🚿</span> Kamar Mandi Dalam</div>
          <div class="facility-item"><span style="width:24px;text-align:center">🧹</span> Kebersihan Terjaga</div>
          <div class="facility-item"><span style="width:24px;text-align:center">📍</span> Lokasi Strategis</div>
        </div>
        <div style="margin-top:1.5rem">
          <div style="font-size:.8rem;color:var(--muted);margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.5px">Cek Ketersediaan Kamar</div>
          <div class="avail-checker">
            <select class="avail-input" id="availMonth">
              <option value="">Pilih bulan masuk...</option>
              @foreach(array_keys($dataKamar) as $bulan)
                <option value="{{ $bulan }}">{{ $bulan }}</option>
              @endforeach
            </select>
            <button class="avail-btn" onclick="cekKetersediaan()">Cek</button>
          </div>
          <div class="avail-result" id="availResult"></div>
        </div>
        <a href="https://wa.me/6289622022001?text=Halo%2C%20saya%20ingin%20info%20kost%20putri" target="_blank" class="wa-btn" style="margin-top:1rem">
          💬 Tanya via WhatsApp
        </a>
      </div>
      <div class="kost-gallery-grid">
        <div style="grid-row:span 2;border-radius:8px 4px 4px 8px;overflow:hidden">
          <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=600&q=80" alt="Kamar Kost Utama">
        </div>
        <div style="overflow:hidden;border-radius:4px">
          <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=400&q=80" alt="Ruang Kost">
        </div>
        <div style="overflow:hidden;border-radius:4px 8px 8px 4px">
          <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=400&q=80" alt="Fasilitas Kost">
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ════════════ SECTION REVIEWS ════════════ --}}
<section id="reviews" class="reviews-section">
  <div class="container">
    <div class="section-header-row">
      <div>
        <div class="section-label">Testimoni</div>
        <h2 class="section-title">Kata Pelanggan Kami</h2>
      </div>
      <div class="review-tabs">
        <button class="tab-btn active" id="tabTenda" onclick="filterUlasan('tenda',this)">Tenda</button>
        <button class="tab-btn" id="tabKost" onclick="filterUlasan('kost',this)">Kost</button>
      </div>
    </div>

    {{-- Rating Summary (berubah animasi sesuai tab) --}}
    <div class="rating-summary">
      <div style="text-align:center;padding-right:1.5rem;border-right:1px solid rgba(255,255,255,0.08)">
        <div class="rating-big" id="ratingAngka">4.8</div>
        <div class="rating-stars" id="ratingBintang">★★★★★</div>
        <div class="rating-count" id="ratingCount">5 ulasan Google</div>
      </div>
      <div class="rating-bars" style="flex:1;padding-left:.5rem" id="ratingBars">
        <div class="rating-bar-row"><span class="bar-label">5</span><div class="bar-track"><div class="bar-fill" id="bar5" style="width:80%"></div></div><span class="bar-pct" id="pct5">80%</span></div>
        <div class="rating-bar-row"><span class="bar-label">4</span><div class="bar-track"><div class="bar-fill" id="bar4" style="width:20%"></div></div><span class="bar-pct" id="pct4">20%</span></div>
        <div class="rating-bar-row"><span class="bar-label">3</span><div class="bar-track"><div class="bar-fill" id="bar3" style="width:0%"></div></div><span class="bar-pct" id="pct3">0%</span></div>
        <div class="rating-bar-row"><span class="bar-label">2</span><div class="bar-track"><div class="bar-fill" id="bar2" style="width:0%"></div></div><span class="bar-pct" id="pct2">0%</span></div>
        <div class="rating-bar-row"><span class="bar-label">1</span><div class="bar-track"><div class="bar-fill" id="bar1" style="width:0%"></div></div><span class="bar-pct" id="pct1">0%</span></div>
      </div>
    </div>

    <div class="reviews-grid" id="reviewsGrid">
      {{-- Ulasan Tenda --}}
      <div class="review-card" data-cat="tenda">
        <div class="review-header">
          <div class="reviewer-info"><div class="avatar">TDF</div><div><div class="reviewer-name">Tedy Dwi Fani</div><div class="reviewer-role">Local Guide</div></div></div>
          <span class="review-badge badge-tenda">Tenda</span>
        </div>
        <div class="stars-row">★★★★★</div>
        <p class="review-text">Tenda Dan kostnya menarik</p>
        <div class="review-time">5 years ago</div>
      </div>
      <div class="review-card" data-cat="tenda">
        <div class="review-header">
          <div class="reviewer-info"><div class="avatar">AS</div><div><div class="reviewer-name">Ahmad Syobirin</div><div class="reviewer-role">Local Guide</div></div></div>
          <span class="review-badge badge-tenda">Tenda</span>
        </div>
        <div class="stars-row">★★★★★</div>
        <p class="review-text">Lumayan Bagus!</p>
        <div class="review-time">5 years ago</div>
      </div>
      <div class="review-card" data-cat="tenda">
        <div class="review-header">
          <div class="reviewer-info"><div class="avatar">IA</div><div><div class="reviewer-name">Ikhlassul Amaliah</div><div class="reviewer-role">Local Guide</div></div></div>
          <span class="review-badge badge-tenda">Tenda</span>
        </div>
        <div class="stars-row">★★★★★</div>
        <p class="review-text">Sip</p>
        <div class="review-time">6 years ago</div>
      </div>
      <div class="review-card" data-cat="tenda">
        <div class="review-header">
          <div class="reviewer-info"><div class="avatar">DCR</div><div><div class="reviewer-name">DICKA CHAIDAR RAHMAN</div><div class="reviewer-role">Local Guide</div></div></div>
          <span class="review-badge badge-tenda">Tenda</span>
        </div>
        <div class="stars-row">★★★★★</div>
        <p class="review-text">Sip</p>
        <div class="review-time">5 years ago</div>
      </div>

      {{-- Ulasan Kost --}}
      <div class="review-card" data-cat="kost" style="display:none">
        <div class="review-header">
          <div class="reviewer-info"><div class="avatar">JKSR</div><div><div class="reviewer-name">Java King Saget Ramadhan</div><div class="reviewer-role">Local Guide</div></div></div>
          <span class="review-badge badge-kost">Kost</span>
        </div>
        <div class="stars-row">★★★★★</div>
        <p class="review-text">Bagus sekali, semua nya ada disini, PS ada, studio ada, dapur ada, WiFi ada, mushola ada,bengkel ada, pokok nya selagi ada pak Asep dan Koko semua nya ada, terimakasih gurau kost</p>
        <div class="review-time">4 years ago</div>
      </div>
      <div class="review-card" data-cat="kost" style="display:none">
        <div class="review-header">
          <div class="reviewer-info"><div class="avatar">TEA</div><div><div class="reviewer-name">Taufik Erwin April</div><div class="reviewer-role">Local Guide</div></div></div>
          <span class="review-badge badge-kost">Kost</span>
        </div>
        <div class="stars-row">★★★★★</div>
        <p class="review-text">Ini tempat kost yang cukup luas fasilitas lengkap</p>
        <div class="review-time">2 years ago</div>
      </div>
      <div class="review-card" data-cat="kost" style="display:none">
        <div class="review-header">
          <div class="reviewer-info"><div class="avatar">A</div><div><div class="reviewer-name">Adiansyah</div><div class="reviewer-role">Local Guide</div></div></div>
          <span class="review-badge badge-kost">Kost</span>
        </div>
        <div class="stars-row">★★★★★</div>
        <p class="review-text">Kumpulan budak tanjung Enim 😄</p>
        <div class="review-time">3 years ago</div>
      </div>
      <div class="review-card" data-cat="kost" style="display:none">
        <div class="review-header">
          <div class="reviewer-info"><div class="avatar">NS</div><div><div class="reviewer-name">Napisah Sari</div><div class="reviewer-role">Local Guide</div></div></div>
          <span class="review-badge badge-kost">Kost</span>
        </div>
        <div class="stars-row">★★★★★</div>
        <p class="review-text">Kost-kost an strategis 👌🏻</p>
        <div class="review-time">7 years ago</div>
    </div>
  </div>
</section>

{{-- ════════════ SECTION KONTAK ════════════ --}}
<section id="contact" style="background:var(--dark)">
  <div class="container">
    <div class="section-header-row">
      <div>
        <div class="section-label">Lokasi &amp; Kontak</div>
        <h2 class="section-title">Temukan Kami</h2>
        <p class="section-desc">Kunjungi lokasi sewa tenda atau kost putri kami langsung di Palembang.</p>
      </div>
    </div>
    <div class="contact-info-row">
      <div class="contact-card">
        <div class="contact-icon">📞</div>
        <div>
          <h4>Telepon / WhatsApp</h4>
          <p>0896-2202-2001</p>
          <a href="https://wa.me/6289622022001" target="_blank" class="wa-btn" style="margin-top:.5rem">💬 Chat WhatsApp</a>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-icon">🕐</div>
        <div>
          <h4>Jam Operasional</h4>
          <p>Buka setiap hari mulai pukul 08.00 WIB</p>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-icon">📍</div>
        <div>
          <h4>Area Layanan</h4>
          <p>Jl. Sungai Sahang, Lorok Pakjo, Kec. Ilir Bar. I, Kota Palembang, Sumatera Selatan</p>
        </div>
      </div>
    </div>
    <div class="dual-map-wrap">
      <div class="map-box">
        <div class="map-box-header">
          <div class="map-box-title">
            <div class="map-box-icon map-icon-tenda">🏕️</div>
            <div>
              <div class="map-box-name">Gurau Tenda — Sewa Tenda</div>
              <div class="map-box-sub">Jl. Sungai Sahang, Lorok Pakjo, Kec. Ilir Bar. I, Kota Palembang</div>
            </div>
          </div>
          <a href="https://maps.app.goo.gl/Ko4X6srwiuR6TQNE6" target="_blank" class="map-open-link">Buka Maps →</a>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.425699112809!2d104.7288354757262!3d-2.979270639821773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b75119b5b25d3%3A0xdb963a90fb31ae43!2sGURAU%20TENDA!5e0!3m2!1sen!2sid!4v1776979411076!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="map-box">
        <div class="map-box-header">
          <div class="map-box-title">
            <div class="map-box-icon map-icon-kost">🏠</div>
            <div>
              <div class="map-box-name">Gurau Kost — Kost Putri</div>
              <div class="map-box-sub">Jl. Sungai Sahang, Lorok Pakjo, Kec. Ilir Bar. I, Kota Palembang</div>
            </div>
          </div>
          <a href="https://maps.app.goo.gl/byiciiCJfVzj4N5c6" target="_blank" class="map-open-link">Buka Maps →</a>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3984.4278268214002!2d104.729364!3d-2.9786827!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b756f11dbd353%3A0x3b60968a9fa2aed7!2sGurau%20kost!5e0!3m2!1sen!2sid!4v1776979480171!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

<footer>
  <p>&copy; 2026 <span>Gurau Tenda</span> Palembang &middot; All Rights Reserved &middot;</p>
</footer>

<a href="https://wa.me/6289622022001" target="_blank" class="wa-float" title="Chat WhatsApp">💬</a>

@endsection

@push('scripts')
<script>
  // ── URL endpoint Laravel ──
  var urlCekKamar        = "{{ route('kamar.cek') }}";
  var urlLoginAdmin      = "{{ route('admin.login') }}";
  var urlSimpanAdmin     = "{{ route('admin.simpanStatus') }}";
  var urlLogoutAdmin     = "{{ route('admin.logout') }}";
  var urlSimpanPemesanan = "{{ route('pemesanan.simpan') }}";
  var urlDaftarPemesanan = "{{ route('admin.pemesanan') }}";
  var csrfToken          = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var dataKamar          = @json($dataKamar);

  // ─────────────────────────────────────────────
  // DATA WARNA PER JENIS TENDA
  // ─────────────────────────────────────────────
  var warnaPerTenda = {
    biasa: [
      { value: 'merah_gold',   label: 'Merah & Gold' },
      { value: 'putih_biru',   label: 'Putih & Biru' },
    ],
    semivip: [
      { value: 'abu_putih',    label: 'Abu & Putih' },
      { value: 'lilac_putih',  label: 'Lilac & Putih' },
    ],
    vip: [
      { value: 'moca_putih',        label: 'Moca & Putih' },
      { value: 'pink_putih',        label: 'Pink & Putih' },
      { value: 'biru_putih',        label: 'Biru & Putih' },
      { value: 'merah_putih',       label: 'Merah & Putih' },
      { value: 'merah_maroon',      label: 'Merah Maroon & Putih' },
      { value: 'cream_putih',       label: 'Cream & Putih' },
      { value: 'abu_putih_vip',     label: 'Abu & Putih' },
    ],
    // Balon & Sentris tidak ada warna
    balon:   [],
    sentris: [],
  };

  // ─────────────────────────────────────────────
  // HARGA & LABEL
  // ─────────────────────────────────────────────
  var hargaTenda  = { biasa:150000, semivip:250000, vip:350000, balon:850000, sentris:600000 };
  var labelTenda  = { biasa:'Tenda Biasa', semivip:'Tenda Semi VIP', vip:'Tenda VIP', balon:'Tenda Balon', sentris:'Tenda Sentris' };
  var labelUkuran = { kecil:'Kecil (3×2m)', sedang:'Sedang (4×5m)', besar:'Besar (5×5m)' };
  var hargaKursi  = { none:0, biasa:2000, cover:5000 };
  var labelKursi  = { none:'Tidak Pakai Kursi', biasa:'Kursi Biasa', cover:'Kursi + Cover' };
  var hargaMeja   = { none:0, kado:100000, makan:150000 };
  var labelMeja   = { none:'Tidak Pakai Meja', kado:'Meja Kado (include cover)', makan:'Meja Makan (include cover)' };
  var HARGA_PANGGUNG = 350000;

  var unit  = 1;
  var kursi = 50;
  var meja  = 1;

  function formatRp(n) {
    return 'Rp ' + Math.round(n).toLocaleString('id-ID');
  }

  // ─────────────────────────────────────────────
  // UPDATE DROPDOWN WARNA SESUAI JENIS TENDA
  // ─────────────────────────────────────────────
  function updateOpsiWarna(jenis) {
    var warnaRow = document.getElementById('warnaRow');
    var elWarna  = document.getElementById('tentColor');
    var opsi     = warnaPerTenda[jenis] || [];

    if (opsi.length === 0) {
      // Balon & Sentris: sembunyikan pilihan warna
      warnaRow.style.display = 'none';
      elWarna.innerHTML = '';
    } else {
      warnaRow.style.display = 'block';
      elWarna.innerHTML = opsi.map(function(w) {
        return '<option value="' + w.value + '">' + w.label + '</option>';
      }).join('');
    }
  }

  // ─────────────────────────────────────────────
  // EVENT: GANTI JENIS TENDA
  // ─────────────────────────────────────────────
  function onTentTypeChange() {
    var jenis = document.getElementById('tentType').value;

    // Warning balon (min 2 unit)
    var warn = document.getElementById('balonWarning');
    warn.style.display = (jenis === 'balon') ? 'block' : 'none';
    if (jenis === 'balon' && unit < 2) {
      unit = 2;
      document.getElementById('unitsDisplay').textContent = unit;
    }

    // Update opsi warna
    updateOpsiWarna(jenis);
    hitungHarga();
  }

  // ─────────────────────────────────────────────
  // HITUNG HARGA
  // ─────────────────────────────────────────────
  function hitungHarga() {
    var jenis     = document.getElementById('tentType').value;
    var ukuran    = document.getElementById('tentSize').value;
    var tipeKursi = document.getElementById('chairType').value;
    var tipeMeja  = document.getElementById('mejaType').value;
    var panggung  = document.getElementById('panggungType').value;

    // Tenda
    var totalTenda = (hargaTenda[jenis] || 150000) * unit;

    // Kursi
    var totalKursi = (hargaKursi[tipeKursi] || 0) * kursi;
    document.getElementById('chairQtyRow').style.display = (tipeKursi !== 'none') ? 'block' : 'none';

    // Meja
    var totalMeja = (hargaMeja[tipeMeja] || 0) * meja;
    document.getElementById('mejaQtyRow').style.display = (tipeMeja !== 'none') ? 'block' : 'none';

    // Panggung
    var totalPanggung = (panggung === 'ada') ? HARGA_PANGGUNG : 0;

    var total = totalTenda + totalKursi + totalMeja + totalPanggung;
    document.getElementById('totalPrice').textContent = formatRp(total);

    // Breakdown
    var elWarna = document.getElementById('tentColor');
    var namaWarna = (elWarna && elWarna.options.length > 0) ? elWarna.options[elWarna.selectedIndex].text : '-';

    var baris = '';
    baris += '<div class="breakdown-item"><span class="item-label">' + labelTenda[jenis] + ' × ' + unit + ' unit</span><span class="item-val">' + formatRp(totalTenda) + '</span></div>';
    baris += '<div class="breakdown-item"><span class="item-label">Ukuran: ' + labelUkuran[ukuran] + '</span><span class="item-val" style="color:var(--muted);font-size:.8rem">Informasi Ukuran</span></div>';

    if (warnaPerTenda[jenis] && warnaPerTenda[jenis].length > 0) {
      baris += '<div class="breakdown-item"><span class="item-label">Warna: ' + namaWarna + '</span><span class="item-val" style="color:var(--muted);font-size:.8rem">Informasi Warna</span></div>';
    }
    if (tipeKursi !== 'none') {
      baris += '<div class="breakdown-item"><span class="item-label">' + labelKursi[tipeKursi] + ' × ' + kursi + ' pcs</span><span class="item-val">' + formatRp(totalKursi) + '</span></div>';
    }
    if (panggung === 'ada') {
      baris += '<div class="breakdown-item"><span class="item-label">Panggung 5×5 m</span><span class="item-val">' + formatRp(totalPanggung) + '</span></div>';
    }
    if (tipeMeja !== 'none') {
      baris += '<div class="breakdown-item"><span class="item-label">' + labelMeja[tipeMeja] + ' × ' + meja + ' pcs</span><span class="item-val">' + formatRp(totalMeja) + '</span></div>';
    }
    baris += '<div class="breakdown-item total"><span class="item-label">Total Estimasi</span><span class="item-val">' + formatRp(total) + '</span></div>';
    document.getElementById('breakdown').innerHTML = baris;
  }

  // ─────────────────────────────────────────────
  // UBAH QUANTITY
  // ─────────────────────────────────────────────
  function ubahQty(tipe, delta) {
    if (tipe === 'units') {
      var jenis   = document.getElementById('tentType').value;
      var minUnit = (jenis === 'balon') ? 2 : 1;
      unit = Math.max(minUnit, Math.min(50, unit + delta));
      document.getElementById('unitsDisplay').textContent = unit;
    } else if (tipe === 'chairs') {
      kursi = Math.max(10, Math.min(1000, kursi + delta));
      document.getElementById('chairsDisplay').textContent = kursi;
    } else if (tipe === 'meja') {
      meja = Math.max(1, Math.min(100, meja + delta));
      document.getElementById('mejaDisplay').textContent = meja;
    }
    hitungHarga();
  }

  // ─────────────────────────────────────────────
  // KONFIRMASI PEMESANAN → SIMPAN DB + BUKA WA
  // ─────────────────────────────────────────────
  function konfirmasiPesan() {
    var elJenis   = document.getElementById('tentType');
    var elUkuran  = document.getElementById('tentSize');
    var elWarna   = document.getElementById('tentColor');
    var elKursi   = document.getElementById('chairType');
    var elMeja    = document.getElementById('mejaType');
    var elPanggung= document.getElementById('panggungType');

    var namaJenis   = elJenis.options[elJenis.selectedIndex].text.split('—')[0].trim();
    var namaUkuran  = elUkuran.options[elUkuran.selectedIndex].text;
    var namaWarna   = (elWarna && elWarna.options.length > 0) ? elWarna.options[elWarna.selectedIndex].text : '-';
    var namaKursi   = elKursi.options[elKursi.selectedIndex].text.split('—')[0].trim();
    var namaMeja    = elMeja.options[elMeja.selectedIndex].text.split('—')[0].trim();
    var pakaiPanggung = elPanggung.value === 'ada';
    var jumlahKursiVal = (elKursi.value !== 'none') ? kursi : 0;
    var jumlahMejaVal  = (elMeja.value !== 'none') ? meja : 0;
    var hargaAngka  = parseInt(document.getElementById('totalPrice').textContent.replace(/[^0-9]/g, ''));

    // Simpan ke database
    fetch(urlSimpanPemesanan, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
      body: JSON.stringify({
        jenis_tenda:    namaJenis,
        jumlah_unit:    unit,
        ukuran_tenda:   namaUkuran,
        warna_dekor:    namaWarna,
        jenis_kursi:    namaKursi,
        jumlah_kursi:   jumlahKursiVal,
        estimasi_harga: hargaAngka,
        pakai_panggung: pakaiPanggung,
        jenis_meja:     jumlahMejaVal > 0 ? namaMeja : null,
        jumlah_meja:    jumlahMejaVal,
      })
    })
    .finally(function() {
      // Buka WhatsApp
      var pesan = 'Halo Gurau Tenda, saya ingin memesan:\n'
        + '- Jenis: ' + namaJenis + '\n'
        + '- Jumlah: ' + unit + ' unit\n'
        + '- Ukuran: ' + namaUkuran + '\n'
        + (namaWarna !== '-' ? '- Warna: ' + namaWarna + '\n' : '')
        + (jumlahKursiVal > 0 ? '- Kursi: ' + namaKursi + ' x ' + jumlahKursiVal + ' pcs\n' : '')
        + (pakaiPanggung ? '- Panggung: 5x5 m\n' : '')
        + (jumlahMejaVal > 0 ? '- Meja: ' + namaMeja + ' x ' + jumlahMejaVal + ' pcs\n' : '')
        + '- Estimasi: ' + document.getElementById('totalPrice').textContent;
      window.open('https://wa.me/6282279996174?text=' + encodeURIComponent(pesan), '_blank');
    });
  }
  // ─────────────────────────────────────────────
  // CEK KETERSEDIAAN KAMAR
  // ─────────────────────────────────────────────
  function cekKetersediaan() {
    var bulan   = document.getElementById('availMonth').value;
    var elHasil = document.getElementById('availResult');
    if (!bulan) { elHasil.style.display = 'none'; return; }
    fetch(urlCekKamar + '?bulan=' + encodeURIComponent(bulan))
      .then(function(res) { return res.json(); })
      .then(function(data) {
        elHasil.style.display = 'block';
        if (data.tersedia) {
          elHasil.className   = 'avail-result avail-yes';
          elHasil.textContent = '✓ Tersedia! ' + data.jumlahKamar + ' kamar kosong untuk ' + data.bulan + '.';
        } else {
          elHasil.className   = 'avail-result avail-no';
          elHasil.textContent = '✗ Penuh untuk ' + data.bulan + '. Hubungi kami untuk daftar tunggu.';
        }
      });
  }

  // ─────────────────────────────────────────────
  // FILTER ULASAN
  // ─────────────────────────────────────────────
  // ─────────────────────────────────────────────
// DATA RATING PER KATEGORI
// ─────────────────────────────────────────────
var dataRating = {
  tenda: {
    nilai: 4.8,
    total: 5,
    bar: { 5: 80, 4: 20, 3: 0, 2: 0, 1: 0 }
  },
  kost: {
    nilai: 4.2,
    total: 17,
    bar: {
      5: Math.round(12/17*100),  // ~71%
      4: Math.round(1/17*100),   // ~6%
      3: Math.round(1/17*100),   // ~6%
      2: Math.round(1/17*100),   // ~6%
      1: Math.round(2/17*100)    // ~12%
    }
  }
};

function filterUlasan(kategori, tombol) {
  // Update tab aktif
  document.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); });
  tombol.classList.add('active');

  // Tampilkan/sembunyikan kartu ulasan
  document.querySelectorAll('.review-card').forEach(function(c) {
    c.style.display = (c.dataset.cat === kategori) ? 'block' : 'none';
  });

  // Animasi rating summary
  animasiRating(kategori);
}

function animasiRating(kategori) {
  var data = dataRating[kategori];

  // Animasi angka rating
  var elAngka = document.getElementById('ratingAngka');
  var start = 0;
  var target = data.nilai;
  var durasi = 600;
  var langkah = target / 30;
  var timer = setInterval(function() {
    start += langkah;
    if (start >= target) {
      start = target;
      clearInterval(timer);
    }
    elAngka.textContent = start.toFixed(1);
  }, durasi / 30);

  // Update bintang
  var bintang = Math.round(data.nilai);
  document.getElementById('ratingBintang').textContent = '★'.repeat(bintang) + '☆'.repeat(5 - bintang);

  // Update jumlah ulasan
  document.getElementById('ratingCount').textContent = data.total + ' ulasan Google';

  // Animasi bar
  [5, 4, 3, 2, 1].forEach(function(bintangKe) {
    var elBar = document.getElementById('bar' + bintangKe);
    var elPct = document.getElementById('pct' + bintangKe);
    var targetPct = data.bar[bintangKe] || 0;

    elBar.style.transition = 'none';
    elBar.style.width = '0%';
    elPct.textContent = '0%';

    setTimeout(function() {
      elBar.style.transition = 'width 0.8s ease';
      elBar.style.width = targetPct + '%';
      elPct.textContent = targetPct + '%';
    }, 150);
  });
}

  // ─────────────────────────────────────────────
  // HAMBURGER MENU
  // ─────────────────────────────────────────────
  function toggleMenu() {
    document.getElementById('navLinks').classList.toggle('open');
  }
  document.addEventListener('click', function(e) {
    var menu = document.getElementById('navLinks');
    var btn  = document.getElementById('hamburger');
    if (menu.classList.contains('open') && !menu.contains(e.target) && !btn.contains(e.target)) {
      menu.classList.remove('open');
    }
  });

  // ─────────────────────────────────────────────
  // ANIMASI COUNTER
  // ─────────────────────────────────────────────
  function animasiCounter(id, target, suffix, durasi) {
    var el = document.getElementById(id), mulai = 0, langkah = target / 60;
    var timer = setInterval(function() {
      mulai += langkah;
      if (mulai >= target) { mulai = target; clearInterval(timer); }
      el.textContent = (target % 1 === 0 ? Math.floor(mulai) : mulai.toFixed(1)) + suffix;
    }, durasi / 60);
  }
  setTimeout(function() {
    animasiCounter('c1', 4.8, '★', 1200);
    animasiCounter('c2', 4.2, '★', 1200);
    animasiCounter('c3', 20, '+', 1000);
  }, 400);

  // ─────────────────────────────────────────────
  // ADMIN: LOGIN & LOGOUT
  // ─────────────────────────────────────────────
  var sudahLogin = false;

  function bukaLogin() {
    document.getElementById('loginModal').classList.add('show');
    document.getElementById('loginUser').value = '';
    document.getElementById('loginPass').value = '';
    document.getElementById('loginError').style.display = 'none';
    setTimeout(function(){ document.getElementById('loginUser').focus(); }, 100);
  }
  function tutupLogin() { document.getElementById('loginModal').classList.remove('show'); }
  function tutupLoginBg(e) { if (e.target === document.getElementById('loginModal')) tutupLogin(); }

  function prosesLogin() {
    var u = document.getElementById('loginUser').value.trim();
    var p = document.getElementById('loginPass').value;
    fetch(urlLoginAdmin, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
      body: JSON.stringify({ username: u, password: p })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data.status === 'berhasil') {
        sudahLogin = true;
        tutupLogin();
        document.getElementById('btnAdminLogin').style.display  = 'none';
        document.getElementById('btnAdminLogout').style.display = 'flex';
        buatPanelAdmin();
        document.getElementById('adminPanel').classList.add('show');
      } else {
        var elErr = document.getElementById('loginError');
        elErr.style.display = 'block';
        document.getElementById('loginPass').value = '';
        setTimeout(function(){ elErr.style.display='none'; }, 3000);
      }
    });
  }

  function adminLogout() {
    fetch(urlLogoutAdmin, { method:'POST', headers:{'X-CSRF-TOKEN':csrfToken} })
    .finally(function() {
      sudahLogin = false;
      document.getElementById('btnAdminLogin').style.display  = 'flex';
      document.getElementById('btnAdminLogout').style.display = 'none';
      document.getElementById('adminPanel').classList.remove('show');
    });
  }

  function togglePanel() {
    if (!sudahLogin) return;
    document.getElementById('adminPanel').classList.toggle('show');
  }

  // ─────────────────────────────────────────────
  // ADMIN: TAB SWITCHER
  // ─────────────────────────────────────────────
  function gantiTabAdmin(tab, tombol) {
    var tKamar   = document.getElementById('tabKamar');
    var tHistory = document.getElementById('tabHistory');
    [tKamar, tHistory].forEach(function(t) {
      t.style.background  = 'transparent';
      t.style.color       = 'var(--muted)';
      t.style.borderColor = 'rgba(255,255,255,0.1)';
      t.style.fontWeight  = 'normal';
    });
    tombol.style.background  = 'var(--gold)';
    tombol.style.color       = 'var(--dark)';
    tombol.style.borderColor = 'var(--gold)';
    tombol.style.fontWeight  = '500';
    if (tab === 'kamar') {
      document.getElementById('panelKamar').style.display   = 'block';
      document.getElementById('panelHistory').style.display = 'none';
    } else {
      document.getElementById('panelKamar').style.display   = 'none';
      document.getElementById('panelHistory').style.display = 'block';
      muatHistoryPemesanan();
    }
  }

  // ─────────────────────────────────────────────
  // ADMIN: PANEL KAMAR
  // ─────────────────────────────────────────────
  function buatPanelAdmin() {
    var list = document.getElementById('adminRoomList');
    var html = '';
    Object.keys(dataKamar).forEach(function(bulan) {
      var d = dataKamar[bulan];
      var sid = bulan.replace(/\s/g, '_');
      html += '<div class="admin-room-row">';
      html += '<span class="admin-month-name"><span class="status-dot '+(d.tersedia?'dot-avail':'dot-full')+'" id="dot_'+sid+'"></span>'+bulan+'</span>';
      html += '<div class="admin-controls">';
      html += '<div class="toggle-wrap"><span class="toggle-label">'+(d.tersedia?'Tersedia':'Penuh')+'</span>';
      html += '<label class="toggle"><input type="checkbox" id="tog_'+sid+'" '+(d.tersedia?'checked':'')+' onchange="onToggleKetersediaan(\''+bulan+'\',this)"><span class="toggle-slider"></span></label></div>';
      html += '<div class="admin-qty"><button class="admin-qty-btn" onclick="adminUbahQty(\''+bulan+'\',-1)">−</button><span class="admin-qty-num" id="qty_'+sid+'">'+d.jumlah_kamar+'</span><button class="admin-qty-btn" onclick="adminUbahQty(\''+bulan+'\',1)">+</button></div>';
      html += '</div></div>';
    });
    list.innerHTML = html;
  }

  function onToggleKetersediaan(bulan, el) {
    var sid = bulan.replace(/\s/g,'_');
    dataKamar[bulan].tersedia = el.checked;
    var lbl = el.closest('.toggle-wrap').querySelector('.toggle-label');
    if (lbl) lbl.textContent = el.checked ? 'Tersedia' : 'Penuh';
    var dot = document.getElementById('dot_'+sid);
    if (dot) dot.className = 'status-dot '+(el.checked?'dot-avail':'dot-full');
    if (!el.checked) { dataKamar[bulan].jumlah_kamar=0; var q=document.getElementById('qty_'+sid); if(q)q.textContent='0'; }
  }

  function adminUbahQty(bulan, delta) {
    var sid  = bulan.replace(/\s/g,'_');
    var next = Math.max(0, Math.min(20, (dataKamar[bulan].jumlah_kamar||0) + delta));
    dataKamar[bulan].jumlah_kamar = next;
    var q = document.getElementById('qty_'+sid); if(q) q.textContent = next;
    dataKamar[bulan].tersedia = next > 0;
    var tog = document.getElementById('tog_'+sid);
    if (tog) { tog.checked=next>0; var l=tog.closest('.toggle-wrap').querySelector('.toggle-label'); if(l) l.textContent=next>0?'Tersedia':'Penuh'; }
    var dot = document.getElementById('dot_'+sid);
    if (dot) dot.className = 'status-dot '+(next>0?'dot-avail':'dot-full');
  }

  function simpanDataAdmin() {
    var dataKirim = {};
    Object.keys(dataKamar).forEach(function(b) {
      dataKirim[b] = { avail: dataKamar[b].tersedia, rooms: dataKamar[b].jumlah_kamar };
    });
    fetch(urlSimpanAdmin, {
      method: 'POST',
      headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN':csrfToken },
      body: JSON.stringify({ data: dataKirim })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      var msg = document.getElementById('savedMsg');
      msg.textContent   = data.pesan || '✓ Berhasil disimpan!';
      msg.style.display = 'block';
      setTimeout(function(){ msg.style.display='none'; }, 2500);
    });
  }

  // ─────────────────────────────────────────────
  // ADMIN: HISTORY PEMESANAN
  // ─────────────────────────────────────────────
  function muatHistoryPemesanan() {
    var kontainer = document.getElementById('historyPemesananList');
    kontainer.innerHTML = '<div style="text-align:center;color:var(--muted);padding:1rem;font-size:.85rem">Memuat data...</div>';
    fetch(urlDaftarPemesanan, { headers:{'X-CSRF-TOKEN':csrfToken} })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (!data.data || data.data.length === 0) {
        kontainer.innerHTML = '<div style="text-align:center;color:var(--muted);padding:1rem;font-size:.85rem">Belum ada pemesanan masuk.</div>';
        return;
      }
      var html = '';
      data.data.forEach(function(item) {
        html += '<div class="history-item">';
        html += '<div class="history-tanggal">🕐 ' + item.tanggal_pesan + '</div>';
        html += '<div class="history-detail">';
        html += '<span>📦 ' + item.jenis_tenda + ' × ' + item.jumlah_unit + ' unit</span>';
        html += '<span>📐 ' + item.ukuran_tenda + '</span>';
        if (item.warna_dekor && item.warna_dekor !== '-') html += '<span>🎨 ' + item.warna_dekor + '</span>';
        if (item.jumlah_kursi > 0) html += '<span>🪑 ' + item.jenis_kursi + ' × ' + item.jumlah_kursi + '</span>';
        if (item.pakai_panggung) html += '<span>🎪 Panggung 5×5</span>';
        if (item.jumlah_meja > 0) html += '<span>🪞 ' + item.jenis_meja + ' × ' + item.jumlah_meja + '</span>';
        html += '</div>';
        html += '<div class="history-harga">' + item.estimasi_harga + '</div>';
        html += '</div>';
      });
      kontainer.innerHTML = html;
    })
    .catch(function() {
      kontainer.innerHTML = '<div style="text-align:center;color:#ff6b6b;padding:1rem;font-size:.85rem">Gagal memuat data.</div>';
    });
  }

  // Inisialisasi
  updateOpsiWarna('biasa');
  hitungHarga();
  // Tampilkan rating tenda sebagai default
  animasiRating('tenda');
  document.querySelectorAll('.review-card').forEach(function(c) {
    c.style.display = (c.dataset.cat === 'tenda') ? 'block' : 'none';
  });
</script>

<style>
.history-item{padding:.75rem 0;border-bottom:1px solid rgba(255,255,255,0.04)}
.history-item:last-child{border-bottom:none}
.history-tanggal{font-size:.72rem;color:var(--muted);margin-bottom:.35rem}
.history-detail{display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:.35rem}
.history-detail span{font-size:.75rem;background:rgba(255,255,255,0.05);padding:2px 8px;border-radius:4px;color:var(--white)}
.history-harga{font-size:.85rem;color:var(--gold);font-weight:500}
</style>
@endpush