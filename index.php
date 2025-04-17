<?php
$ip = $_SERVER['REMOTE_ADDR'];
$dataHora = date("Y-m-d H:i:s");

// Localização via API gratuita
$geoJson = @file_get_contents("http://ip-api.com/json/$ip");
$geo = json_decode($geoJson, true);

$dados = [
    'IP' => $ip,
    'DataHora' => $dataHora,
    'Pais' => $geo['country'] ?? 'Desconhecido',
    'Cidade' => $geo['city'] ?? 'Desconhecida',
    'Regiao' => $geo['regionName'] ?? 'Desconhecida',
    'ISP' => $geo['isp'] ?? 'Desconhecido',
];

// Armazena os dados no arquivo CSV (pode usar DB se quiser)
$linha = implode(";", $dados) . PHP_EOL;
file_put_contents("acessos.csv", $linha, FILE_APPEND);

// Retorna o PDF verdadeiro (ou falso)
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=\"documento_importante.pdf\"");
readfile("documento_importante.pdf");
exit();
?>