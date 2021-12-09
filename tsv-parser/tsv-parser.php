<?php

//THIS IS SANTIAGO'S CODE

// $data = file_get_contents('https://docs.google.com/spreadsheets/d/e/2PACX-1vTXjFPyywfftXOCIWaH1HOQK07MQlEx5jkUFkXO36DOT_zDbiSkySXmrE8cJyZGYMefjX01ZgoB2MZ9/pub?output=tsv');
$data = file_get_contents('https://docs.google.com/spreadsheets/d/e/2PACX-1vSUXI9yvWAwQnElpSooWpmoQJdQyo2mp-O_cUwcYt904wD6UBG3lyLS8PlYw9_YHDlABvViJl14E5Dv/pub?output=tsv');
// Break lines
$lines = explode("\n", $data);
$keys = explode("\t", $lines[0]);
$out = [];
for ($i = 1; $i < count($lines); $i++) {
    $data = explode("\t", $lines[$i]);
    $item = [];
    for ($j = 0; $j < count($data); $j++) {
        $data[$j] = str_replace("\r", "", $data[$j]);
        $keys[$j] = str_replace("\r", "", $keys[$j]);
        $item[$keys[$j]] = $data[$j];
    }
    array_push($out, $item);
}
file_put_contents("shop.txt", json_encode($out, JSON_PRETTY_PRINT));
header('Content-Type: application/json');
echo json_encode($out);
