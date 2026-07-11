<?php
// =============================================
// KONFIGURASI DATABASE
// Sesuaikan dengan pengaturan MySQL kamu
// =============================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // username MySQL kamu
define('DB_PASS', '');           // password MySQL kamu (kosong jika XAMPP default)
define('DB_NAME', 'undangan_wisuda');

function getDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        http_response_code(500);
        die(json_encode(['error' => 'Koneksi database gagal: ' . $conn->connect_error]));
    }
    $conn->set_charset('utf8mb4');
    return $conn;
}
