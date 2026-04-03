<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Content-Type: application/json');

// Verilənlər bazası bağlantısı (config.php-ni bura daxil et və ya birbaşa yaz)
require 'config.php';
$db = getDB();

// 1. SES YÜKLƏMƏ (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['audio'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }
    
    $filename = time() . '.m4a';
    if (move_uploaded_file($_FILES['audio']['tmp_name'], $uploadDir . $filename)) {
        $stmt = $db->prepare('INSERT INTO recordings (username, filename) VALUES (?, ?)');
        $stmt->execute(['Zakir', $filename]);
        echo json_encode(['success' => true, 'file' => $filename]);
    }
    exit;
}

// 2. SESLƏRİ LİSTƏLƏMƏ (GET)
$stmt = $db->query('SELECT * FROM recordings ORDER BY id DESC LIMIT 5');
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode(['success' => true, 'recordings' => $res]);
?>