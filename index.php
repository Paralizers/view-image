<?php
function scaricaImmagine($url, $proxy = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36");
  



curl_setopt($ch, CURLOPT_AUTOREFERER, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
    $imageData = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);

    if ($httpCode >= 400 || !$imageData) {
        return false;
    }

    header("Content-Type: $contentType");
    echo $imageData;
    return true;
}

$url = $_GET['img'] ?? null;
if (!$url) {
    http_response_code(400);
    exit("Parametro 'img' mancante.");
}

// Prova senza proxy
if (!scaricaImmagine($url)) {
 

    http_response_code(500);
    exit("Impossibile scaricare l'immagine anche tramite proxy.");
}
?>
