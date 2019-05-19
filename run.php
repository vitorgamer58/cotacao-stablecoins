<?php

//puxa o coinlib

$jsoncoinlib = file_get_contents("https://coinlib.io/api/v1/coin?key=3602a548384fe25c&pref=USD&symbol=USDT,TUSD,DAI"); //puxa os dados da api

$datacoinlib = json_decode($jsoncoinlib, true); //decodifica os dados da api

$usdt_price = $datacoinlib['coins']['0']['price']; //seleciona um valor especifico da api
$usdt_volume = $datacoinlib['coins']['0']['total_volume_24h'];

$tusd_price = $datacoinlib['coins']['1']['price'];
$tusd_volume = $datacoinlib['coins']['1']['total_volume_24h'];

$dai_price = $datacoinlib['coins']['2']['price'];
$dai_volume = $datacoinlib['coins']['2']['total_volume_24h'];

$constant = 1.00;


//Calcula o preco medio ponderado


$c_usdt = round(($usdt_price/$constant)*100, 2);
$c_tusd = round(($tusd_price/$constant)*100, 2);
$c_dai = round(($dai_price/$constant)*100, 2);

?>
