<?php

/*
|--------------------------------------------------------------------------
| Konfigurasi Admin - Gurau Tenda Palembang
|--------------------------------------------------------------------------
| File ini menyimpan kredensial login admin website Gurau Tenda.
|
| PENTING: Ganti nilai 'username' dan 'password' sesuai kebutuhan Anda.
| Lebih aman jika nilai ini diambil dari file .env (environment variable).
|
| Contoh penggunaan di .env:
|   ADMIN_USERNAME=admin
|   ADMIN_PASSWORD=passwordkuatanda123
|
| Lalu di sini gunakan: env('ADMIN_USERNAME', 'admin')
|--------------------------------------------------------------------------
*/

return [

    /*
    |------------------------------------------------------------------
    | Username Admin
    |------------------------------------------------------------------
    | Username untuk login ke panel admin.
    | Default diambil dari .env, fallback ke 'admin'.
    */
    'username' => env('ADMIN_USERNAME', 'admin'),

    /*
    |------------------------------------------------------------------
    | Password Admin
    |------------------------------------------------------------------
    | Password untuk login ke panel admin.
    | GANTI NILAI INI di file .env dengan password yang kuat!
    | Contoh .env: ADMIN_PASSWORD=P@ssw0rdKuat!2024
    */
    'password' => env('ADMIN_PASSWORD', '123palembang'),

];