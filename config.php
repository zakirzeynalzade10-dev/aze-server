<?php
define('DB_HOST', 'sql200.infinityfree.com');
define('DB_NAME', 'if0_41487393_aze_db');
define('DB_USER', 'if0_41487393_aze_user');
define('DB_PASS', 'buraya_sifren');

function getDB() {
    $pdo = new PDO(
        'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',
        DB_USER, DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    return $pdo;
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit(0); }
?>
```

5. `DB_HOST` için → MySQL sekmesine bak, "Server" yazan yerdeki adresi kopyala
6. `DB_USER` → kendi kullanıcı adın
7. `DB_PASS` → koyduğun şifre
8. **Save** tıkla

---

## Sonra .htaccess ekle

1. **"New File"** → isim: `.htaccess` yaz → oluştur
2. **Edit** → şunu yapıştır:
```
Options -Indexes
Header always set Access-Control-Allow-Origin "*"