<?php

$euro = NULL;

$currency = $euro === null ? 'USD' : 'EUR';
$reverseCurrency = $currency === 'EUR' ? 'USD' : 'EUR';

$url = 'https://open.er-api.com/v6/latest/' . $currency;

$data = file_get_contents($url);
$data = json_decode($data, true);

$rate = $data['rates'][$reverseCurrency];

if($euro === null){
    $euro = $dollars * $rate;
    return [
        'EUR' => $euro,
    ];
}
if($dollars === null){
    $dollars = $euro * $rate;
    return [
        'USD' => $dollars,
    ];
}

?>
