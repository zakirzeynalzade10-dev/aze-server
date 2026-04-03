<?php
include 'config.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    if (file_exists(DATA_FILE)) {
        echo file_get_contents(DATA_FILE);
    } else {
        echo json_encode([]);
    }
} elseif ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $currentData = [];
    if (file_exists(DATA_FILE)) {
        $currentData = json_decode(file_get_contents(DATA_FILE), true);
    }
    
    $currentData[] = [
        'id' => time(),
        'text' => $input['text'] ?? '',
        'date' => date('Y-m-d H:i:s')
    ];
    
    file_put_contents(DATA_FILE, json_encode($currentData));
    echo json_encode(['success' => true]);
}
?>
