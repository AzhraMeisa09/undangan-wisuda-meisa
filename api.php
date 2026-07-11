<?php
// =============================================
// API GUESTBOOK — api.php
// Handles GET (ambil pesan) & POST (kirim pesan)
// =============================================

require_once 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$db = getDB();
$action = $_GET['action'] ?? '';

// ---- GET: Ambil semua pesan ----
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $action === 'messages') {
    $page  = max(1, intval($_GET['page'] ?? 1));
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $total = $db->query("SELECT COUNT(*) as cnt FROM guestbook")->fetch_assoc()['cnt'];
    $stmt  = $db->prepare("SELECT * FROM guestbook ORDER BY created_at DESC LIMIT ? OFFSET ?");
    $stmt->bind_param('ii', $limit, $offset);
    $stmt->execute();
    $rows  = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode([
        'success'  => true,
        'messages' => $rows,
        'total'    => (int)$total,
        'page'     => $page,
        'pages'    => ceil($total / $limit),
    ]);
    exit;
}

// ---- POST: Kirim pesan baru ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'send') {
    $body = json_decode(file_get_contents('php://input'), true);
    $name    = trim($body['name'] ?? '');
    $message = trim($body['message'] ?? '');

    if (!$name || !$message) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Nama dan pesan wajib diisi.']);
        exit;
    }

    if (mb_strlen($name) > 100 || mb_strlen($message) > 1000) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Input terlalu panjang.']);
        exit;
    }

    $stmt = $db->prepare("INSERT INTO guestbook (name, message) VALUES (?, ?)");
    $stmt->bind_param('ss', $name, $message);
    $stmt->execute();

    echo json_encode(['success' => true, 'id' => $db->insert_id]);
    exit;
}

// ---- DELETE: Hapus pesan (admin) ----
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $action === 'delete') {
    $id = intval($_GET['id'] ?? 0);
    $adminKey = $_GET['key'] ?? '';

    // Ganti dengan password admin kamu
    if ($adminKey !== 'nadia2026') {
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'Akses ditolak.']);
        exit;
    }

    $stmt = $db->prepare("DELETE FROM guestbook WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    echo json_encode(['success' => true]);
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Endpoint tidak ditemukan.']);
