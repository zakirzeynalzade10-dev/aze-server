<?php
// Render-də verilənlər bazası məlumatlarını bura daxil etməlisən.
// Əgər hələ bazan yoxdursa, kodun işləməsi üçün aşağıdakı bazanı yoxla:
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'aze_db');
define('DB_USER', 'root');
define('DB_PASS', '');

function getDB() {
    try {
        $pdo = new PDO(
            'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',
            DB_USER, DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        return $pdo;
    } catch (Exception $e) {
        die(json_encode(['success' => false, 'error' => 'Baza baglantisi ugursuzdur']));
    }
}
?>
