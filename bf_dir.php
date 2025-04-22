<?php
$baseUrl = "https://de1e-119-18-155-10.ngrok-free.app/simulasi-traversal/"; 
$wordlistFile = "wordlist.txt"; 

// Periksa apakah file wordlist ada
if (!file_exists($wordlistFile)) {
    die("File wordlist tidak ditemukan: $wordlistFile\n");
}

// Baca seluruh isi wordlist
$dirs = file($wordlistFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Fungsi cek direktori
function checkDirectory($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true); // hanya header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $code;
}

// Loop setiap direktori dari wordlist
foreach ($dirs as $dir) {
    $url = $baseUrl . $dir . "/";
    $code = checkDirectory($url);

    if ($code === 200 || $code === 301 || $code === 403) {
        echo "[+] Ditemukan: $url (HTTP $code)\n";
    } else {
        echo "[-] $url (HTTP $code)\n";
    }
}

?>
