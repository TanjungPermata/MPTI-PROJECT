<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice {{ $invoiceNo }}</title>
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f5f5;
      color: #333;
      line-height: 1.6;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      background: white;
      padding: 40px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .invoice-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 40px;
      border-bottom: 2px solid #C9A84C;
      padding-bottom: 20px;
    }

    .company-info h1 {
      font-size: 24px;
      color: #C9A84C;
      margin-bottom: 5px;
      letter-spacing: 2px;
    }

    .company-info p {
      font-size: 12px;
      color: #666;
      margin-bottom: 3px;
    }

    .invoice-meta {
      text-align: right;
    }

    .invoice-meta h2 {
      font-size: 28px;
      color: #333;
      margin-bottom: 10px;
      letter-spacing: 1px;
    }

    .invoice-meta .meta-item {
      font-size: 12px;
      margin-bottom: 5px;
      color: #666;
    }

    .invoice-meta .meta-label {
      font-weight: 600;
      color: #333;
    }

    .invoice-meta .meta-value {
      color: #C9A84C;
      font-weight: 500;
    }

    .invoice-title {
      text-align: center;
      margin: 30px 0;
    }

    .invoice-title h1 {
      font-size: 22px;
      color: #333;
      letter-spacing: 1px;
      margin-bottom: 5px;
    }

    .invoice-title p {
      font-size: 13px;
      color: #666;
    }

    .details-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      margin-bottom: 40px;
      padding: 20px;
      background: #f9f9f9;
      border-radius: 8px;
      border: 1px solid #e5e5e5;
    }

    .detail-section h3 {
      font-size: 12px;
      text-transform: uppercase;
      color: #C9A84C;
      letter-spacing: 1.5px;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      padding: 6px 0;
      font-size: 13px;
      border-bottom: 1px solid #e5e5e5;
    }

    .detail-row:last-child {
      border-bottom: none;
    }

    .detail-row .label {
      color: #666;
      font-weight: 500;
    }

    .detail-row .value {
      color: #333;
      font-weight: 600;
    }

    .items-table {
      width: 100%;
      margin-bottom: 40px;
      border-collapse: collapse;
    }

    .items-table thead {
      background: #C9A84C;
      color: white;
    }

    .items-table th {
      padding: 12px;
      text-align: left;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.5px;
      border: 1px solid #C9A84C;
    }

    .items-table td {
      padding: 12px;
      font-size: 13px;
      border: 1px solid #e5e5e5;
    }

    .items-table tbody tr:nth-child(odd) {
      background: #f9f9f9;
    }

    .items-table tbody tr:hover {
      background: #f0f0f0;
    }

    .items-table .text-center {
      text-align: center;
    }

    .items-table .text-right {
      text-align: right;
    }

    .summary-section {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 40px;
      margin-bottom: 40px;
    }

    .notes {
      font-size: 12px;
      color: #666;
      line-height: 1.6;
    }

    .notes h4 {
      font-size: 12px;
      color: #C9A84C;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 8px;
      font-weight: 600;
    }

    .price-summary {
      border: 2px solid #C9A84C;
      border-radius: 8px;
      padding: 20px;
      background: #faf7f2;
    }

    .price-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
      font-size: 13px;
    }

    .price-row .label {
      color: #666;
    }

    .price-row .value {
      color: #333;
      font-weight: 600;
    }

    .price-row.total {
      margin-top: 12px;
      padding-top: 12px;
      border-top: 2px solid #C9A84C;
      font-size: 16px;
    }

    .price-row.total .label {
      color: #333;
      font-weight: 700;
    }

    .price-row.total .value {
      color: #C9A84C;
      font-weight: 700;
      font-size: 18px;
    }

    .footer {
      border-top: 1px solid #e5e5e5;
      margin-top: 40px;
      padding-top: 20px;
      text-align: center;
      font-size: 11px;
      color: #999;
    }

    .footer p {
      margin-bottom: 5px;
    }

    .buttons {
      display: flex;
      gap: 10px;
      margin-bottom: 30px;
      justify-content: center;
    }

    .btn {
      padding: 10px 24px;
      border: none;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .btn-print {
      background: #C9A84C;
      color: #0F0F0F;
    }

    .btn-print:hover {
      background: #D4AF37;
      box-shadow: 0 4px 12px rgba(201,168,76,0.3);
    }

    .btn-pdf {
      background: #DC2626;
      color: white;
    }

    .btn-pdf:hover {
      background: #B91C1C;
      box-shadow: 0 4px 12px rgba(220,38,38,0.3);
    }

    .btn-back {
      background: #6B7280;
      color: white;
    }

    .btn-back:hover {
      background: #4B5563;
    }

    @media (max-width: 768px) {
      .container {
        padding: 20px;
      }

      .invoice-header {
        flex-direction: column;
        gap: 20px;
      }

      .invoice-meta {
        text-align: left;
      }

      .details-grid {
        grid-template-columns: 1fr;
      }

      .summary-section {
        grid-template-columns: 1fr;
      }

      .buttons {
        flex-direction: column;
      }

      .btn {
        width: 100%;
        justify-content: center;
      }

      .items-table {
        font-size: 12px;
      }

      .items-table th,
      .items-table td {
        padding: 8px;
      }
    }

    @media print {
      body {
        background: white;
      }

      .container {
        box-shadow: none;
        padding: 0;
        max-width: 100%;
      }

      .buttons {
        display: none !important;
      }

      .btn,
      button {
        display: none !important;
      }

      .invoice-header {
        page-break-after: avoid;
      }

      .items-table {
        page-break-inside: avoid;
      }

      .price-summary {
        page-break-inside: avoid;
      }

      * {
        box-shadow: none !important;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    {{-- Tombol Action --}}
    <div class="buttons">
      <button class="btn btn-print" onclick="window.print()">
        Print Invoice
      </button>
      <a href="{{ route('pemesanan.invoice.pdf', $pemesanan->id) }}?nama_pemesan={{ urlencode($profile['nama_pemesan']) }}&nomor_hp={{ urlencode($profile['nomor_hp']) }}&alamat={{ urlencode($profile['alamat']) }}&tanggal_pemasangan={{ urlencode(request()->query('tanggal_pemasangan', '')) }}&tanggal_selesai={{ urlencode(request()->query('tanggal_selesai', '')) }}" class="btn btn-pdf">
        Download PDF
      </a>
      <button class="btn btn-back" onclick="history.back()">
        Kembali
      </button>
    </div>

    {{-- Invoice Header --}}
    <div class="invoice-header">
      <div class="company-info">
        <h1>GURAU TENDA</h1>
        <p>Alamat: Jl. Sungai Sahang, Lorok Pakjo, Kec. Ilir Bar. I, Kota Palembang, Sumatera Selatan</p>
        <p>Telepon: +62-812-7323-654</p>
      </div>
      <div class="invoice-meta">
        <div class="meta-item">
          <span class="meta-label">No. Invoice:</span><br>
          <span class="meta-value" style="font-size: 14px;">{{ $invoiceNo }}</span>
        </div>
        <div class="meta-item" style="margin-top: 15px;">
          <span class="meta-label">Tanggal:</span><br>
          <span class="meta-value">{{ $pemesanan->tanggal_pesan->format('d/m/Y H:i') }}</span>
        </div>
      </div>
    </div>

    {{-- Invoice Title --}}
    <div class="invoice-title">
      <h1>INVOICE PENYEWAAN GURAU TENDA</h1>
      <p>Riwayat Pemesanan & Estimasi Biaya</p>
    </div>

    {{-- Detail Pemesanan --}}
    <div class="details-grid">
      <div class="detail-section">
        <h3>Profil Pemesan</h3>
        <div class="detail-row">
          <span class="label">Nama Pemesan</span>
          <span class="value">{{ $profile['nama_pemesan'] }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Nomor HP</span>
          <span class="value">{{ $profile['nomor_hp'] }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Alamat</span>
          <span class="value">{{ $profile['alamat'] }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Tanggal Pemasangan</span>
          <span class="value">{{ $profile['tanggal_pemasangan'] }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Tanggal Selesai</span>
          <span class="value">{{ $profile['tanggal_selesai'] }}</span>
        </div>
      </div>

      <div class="detail-section">
        <h3>Detail Pesanan</h3>
        <div class="detail-row">
          <span class="label">Jenis Tenda</span>
          <span class="value">{{ $pemesanan->jenis_tenda }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Jumlah Unit</span>
          <span class="value">{{ $pemesanan->jumlah_unit }} unit</span>
        </div>
        <div class="detail-row">
          <span class="label">Ukuran Tenda</span>
          <span class="value">{{ $pemesanan->ukuran_tenda }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Warna Dekor</span>
          <span class="value">{{ $pemesanan->warna_dekor }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Tanggal Pesan</span>
          <span class="value">{{ $pemesanan->tanggal_pesan->format('d/m/Y') }}</span>
        </div>
      </div>
    </div>

    {{-- Tabel Item & Harga --}}
    <table class="items-table">
      <thead>
        <tr>
          <th>Item</th>
          <th>Deskripsi</th>
          <th class="text-center">Qty</th>
          <th class="text-right">Harga</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>Tenda</strong></td>
          <td>{{ $pemesanan->jenis_tenda }}</td>
          <td class="text-center">{{ $pemesanan->jumlah_unit }}</td>
          <td class="text-right">-</td>
        </tr>
        <tr>
          <td colspan="4"><em style="color: #999; font-size: 12px;">- Ukuran: {{ $pemesanan->ukuran_tenda }} | Warna: {{ $pemesanan->warna_dekor }}</em></td>
        </tr>
        @if($pemesanan->jumlah_kursi > 0)
        <tr>
          <td><strong>Kursi</strong></td>
          <td>{{ $pemesanan->jenis_kursi }}</td>
          <td class="text-center">{{ $pemesanan->jumlah_kursi }}</td>
          <td class="text-right">-</td>
        </tr>
        @endif
        @if($pemesanan->pakai_panggung)
        <tr>
          <td><strong>Panggung</strong></td>
          <td>Panggung 5×5 m</td>
          <td class="text-center">1</td>
          <td class="text-right">-</td>
        </tr>
        @endif
        @if($pemesanan->jenis_meja)
        <tr>
          <td><strong>Meja</strong></td>
          <td>{{ $pemesanan->jenis_meja }}</td>
          <td class="text-center">{{ $pemesanan->jumlah_meja }}</td>
          <td class="text-right">-</td>
        </tr>
        @endif
      </tbody>
    </table>

    {{-- Ringkasan Harga --}}
    <div class="summary-section">
      <div class="notes">
        <h4>Catatan Penting</h4>
        <p>
          Invoice ini merupakan estimasi biaya berdasarkan pesanan yang diterima. 
          Biaya final dapat berubah tergantung kondisi lapangan dan permintaan khusus. 
          Harap hubungi Gurau Tenda untuk konfirmasi biaya sebelum pemesanan difinalisasi.
        </p>
        <p style="margin-top: 12px;">
          Terima kasih telah mempercayai <strong>Gurau Tenda</strong> untuk kebutuhan Anda!
        </p>
      </div>

      <div class="price-summary">
        <div class="price-row">
          <span class="label">Subtotal</span>
          <span class="value">{{ $pemesanan->estimasi_harga_format }}</span>
        </div>
        <div class="price-row total">
          <span class="label">TOTAL ESTIMASI</span>
          <span class="value">{{ $pemesanan->estimasi_harga_format }}</span>
        </div>
      </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
      <p>Gurau Tenda Palembang | {{ $invoiceNo }} | {{ now()->format('d/m/Y H:i') }}</p>
      <p>Dokumen ini adalah bukti resmi penerimaan pesanan. Simpan untuk referensi Anda.</p>
    </div>
  </div>
</body>
</html>
