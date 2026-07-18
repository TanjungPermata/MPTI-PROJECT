<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kwitansi {{ $invoiceNo }}</title>
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      color: #333;
      line-height: 1.5;
    }

    .container {
      max-width: 210mm;
      margin: 0 auto;
      padding: 15mm;
      background: white;
    }

    .invoice-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 20px;
      border-bottom: 2px solid #C9A84C;
      padding-bottom: 12px;
    }

    .company-info h1 {
      font-size: 20px;
      color: #C9A84C;
      margin-bottom: 5px;
      letter-spacing: 2px;
    }

    .company-info p {
      font-size: 10px;
      color: #666;
      margin-bottom: 2px;
    }

    .invoice-meta {
      text-align: right;
    }

    .invoice-meta h2 {
      font-size: 24px;
      color: #333;
      margin-bottom: 8px;
      letter-spacing: 1px;
    }

    .invoice-meta .meta-item {
      font-size: 10px;
      margin-bottom: 4px;
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
      margin: 25px 0;
    }

    .invoice-title h1 {
      font-size: 18px;
      color: #333;
      letter-spacing: 1px;
      margin-bottom: 5px;
    }

    .invoice-title p {
      font-size: 11px;
      color: #666;
    }

    .details-grid {
      display: table;
      width: 100%;
      margin-bottom: 18px;
    }

    .detail-col {
      display: table-cell;
      padding: 12px;
      background: #f9f9f9;
      border: 1px solid #e5e5e5;
      width: 50%;
      vertical-align: top;
    }

    .detail-section h3 {
      font-size: 10px;
      text-transform: uppercase;
      color: #C9A84C;
      letter-spacing: 1.5px;
      margin-bottom: 8px;
      font-weight: 600;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      padding: 5px 0;
      font-size: 11px;
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
      text-align: right;
    }

    .items-table {
      width: 100%;
      margin-bottom: 18px;
      border-collapse: collapse;
    }

    .items-table thead {
      background: #C9A84C;
      color: white;
    }

    .items-table th {
      padding: 8px;
      text-align: left;
      font-size: 10px;
      font-weight: 600;
      letter-spacing: 0.5px;
      border: 1px solid #C9A84C;
    }

    .items-table td {
      padding: 8px;
      font-size: 10px;
      border: 1px solid #e5e5e5;
    }

    .items-table tbody tr:nth-child(odd) {
      background: #f9f9f9;
    }

    .items-table .text-center {
      text-align: center;
    }

    .items-table .text-right {
      text-align: right;
    }

    .summary-section {
      display: table;
      width: 100%;
      margin-bottom: 15px;
      border-spacing: 15px;
    }

    .notes-col {
      display: table-cell;
      width: 60%;
      vertical-align: top;
    }

    .price-col {
      display: table-cell;
      width: 40%;
      vertical-align: top;
    }

    .notes {
      font-size: 10px;
      color: #666;
      line-height: 1.5;
    }

    .notes h4 {
      font-size: 10px;
      color: #C9A84C;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 5px;
      font-weight: 600;
    }

    .price-summary {
      border: 2px solid #C9A84C;
      padding: 15px;
      background: #faf7f2;
    }

    .price-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
      font-size: 10px;
    }

    .price-row .label {
      color: #666;
    }

    .price-row .value {
      color: #333;
      font-weight: 600;
    }

    .price-row.total {
      margin-top: 8px;
      padding-top: 8px;
      border-top: 2px solid #C9A84C;
      font-size: 12px;
    }

    .price-row.total .label {
      color: #333;
      font-weight: 700;
    }

    .price-row.total .value {
      color: #C9A84C;
      font-weight: 700;
      font-size: 14px;
    }

    .footer {
      border-top: 1px solid #e5e5e5;
      margin-top: 15px;
      padding-top: 10px;
      text-align: center;
      font-size: 9px;
      color: #999;
    }

    .footer p {
      margin-bottom: 3px;
    }

    .signature-section {
      margin: 30px 0 15px;
      display: flex;
      justify-content: flex-end;
    }

    .signature-box {
      width: 200px;
      text-align: center;
      padding-top: 10px;
    }

    .signature-box p {
      margin-bottom: 6px;
      color: #333;
      font-size: 9px;
    }

    .signature-image {
      display: block;
      max-width: 100%;
      max-height: 100px;
      height: auto;
      margin: 0 auto 6px;
    }

    .signature-name {
      font-weight: 700;
      letter-spacing: 0.4px;
    }

    @page {
      size: A4;
      margin: 15mm;
    }
  </style>
</head>
<body>
  <div class="container">
    {{-- Invoice Header --}}
    <div class="invoice-header">
      <div class="company-info">
        <h1>GURAU TENDA</h1>
        <p>Alamat: Jl. Sungai Sahang, Lorok Pakjo, Kec. Ilir Bar. I, Kota Palembang, Sumatera Selatan</p>
        <p>Telepon: +62-812-7323-654</p>
      </div>
      <div class="invoice-meta">
        <div class="meta-item">
          <span class="meta-label">No. Kwitansi:</span><br>
          <span class="meta-value" style="font-size: 12px;">{{ $invoiceNo }}</span>
        </div>
        <div class="meta-item" style="margin-top: 10px;">
          <span class="meta-label">Tanggal:</span><br>
          <span class="meta-value">{{ $pemesanan->tanggal_pesan->format('d/m/Y H:i') }}</span>
        </div>
      </div>
    </div>

    {{-- Invoice Title --}}
    <div class="invoice-title">
      <h1>KWITANSI PENYEWAAN GURAU TENDA</h1>
      <p>Riwayat Pemesanan & Biaya</p>
    </div>

    {{-- Detail Pemesanan --}}
    <div class="details-grid">
      <div class="detail-col">
        <div class="detail-section">
          <h3>Profil Pemesan</h3>
          <div class="detail-row">
            <span class="label">Nama Pemesan :</span>
            <span class="value">{{ $profile['nama_pemesan'] }}</span>
          </div>
          <div class="detail-row">
            <span class="label">Nomor HP :</span>
            <span class="value">{{ $profile['nomor_hp'] }}</span>
          </div>
          <div class="detail-row">
            <span class="label">Alamat :</span>
            <span class="value">{{ $profile['alamat'] }}</span>
          </div>
          <div class="detail-row">
            <span class="label">Tanggal Pemasangan :</span>
            <span class="value">{{ $profile['tanggal_pemasangan'] }}</span>
          </div>
          <div class="detail-row">
            <span class="label">Tanggal Selesai :</span>
            <span class="value">{{ $profile['tanggal_selesai'] }}</span>
          </div>
        </div>
      </div>

      <div class="detail-col">
        <div class="detail-section">
          <h3>Detail Pesanan</h3>
          <div class="detail-row">
            <span class="label">Jenis Tenda :</span>
            <span class="value">{{ $pemesanan->jenis_tenda }}</span>
          </div>
          <div class="detail-row">
            <span class="label">Jumlah Unit :</span>
            <span class="value">{{ $pemesanan->jumlah_unit }} unit</span>
          </div>
          <div class="detail-row">
            <span class="label">Ukuran Tenda :</span>
            <span class="value">{{ $pemesanan->ukuran_tenda }}</span>
          </div>
          <div class="detail-row">
            <span class="label">Warna Dekor :</span>
            <span class="value">{{ $pemesanan->warna_dekor }}</span>
          </div>
          <div class="detail-row">
            <span class="label">Tanggal Pesan :</span>
            <span class="value">{{ $pemesanan->tanggal_pesan->format('d/m/Y') }}</span>
          </div>
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
          <td colspan="4"><em style="color: #999; font-size: 9px;">- Ukuran: {{ $pemesanan->ukuran_tenda }} | Warna: {{ $pemesanan->warna_dekor }}</em></td>
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
      <div class="notes-col">
        <div class="notes">
          <h4>Catatan Penting</h4>
          <p>
            Kwitansi ini menunjukkan biaya berdasarkan pesanan yang diterima. 
            Biaya final dapat berubah tergantung kondisi lapangan dan permintaan khusus. 
            Harap hubungi Gurau Tenda untuk konfirmasi biaya sebelum pemesanan difinalisasi.
          </p>
          <p style="margin-top: 8px;">
            Terima kasih telah mempercayai <strong>Gurau Tenda</strong> untuk kebutuhan Anda!
          </p>
        </div>
      </div>

      <div class="price-col">
        <div class="price-summary">
          <div class="price-row">
            <span class="label">Subtotal</span>
            <span class="value">{{ $pemesanan->estimasi_harga_format }}</span>
          </div>
          <div class="price-row total">
            <span class="label">TOTAL BIAYA</span>
            <span class="value">{{ $pemesanan->estimasi_harga_format }}</span>
          </div>
        </div>
      </div>
    </div>

    @php
      $signaturePath = public_path('images/signature-owner.png');
      $signatureData = file_exists($signaturePath)
        ? 'data:' . mime_content_type($signaturePath) . ';base64,' . base64_encode(file_get_contents($signaturePath))
        : null;
    @endphp

    <div class="signature-section">
      <div class="signature-box">
        <p>Tanda Tangan Pemilik</p>
        @if($signatureData)
          <img src="{{ $signatureData }}" alt="Tanda Tangan Pemilik" class="signature-image" />
        @else
          <img src="{{ asset('images/signature-owner.png') }}" alt="Tanda Tangan Pemilik" class="signature-image" />
        @endif
        <p class="signature-name">Gurau Tenda</p>
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
