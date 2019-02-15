<?php
include 'view/header.html';
error_reporting(-1);
ini_set('display_errors',1);
ini_set('display_startup_erros',1);

//braziliex
$jsonbraziliex = file_get_contents("https://braziliex.com/api/v1/public/ticker/btc_brl"); //puxa os dados da api
$databrzx = json_decode($jsonbraziliex, true); //decodifica os dados da api
$braziliex_price = $databrzx['last']; //seleciona um valor especifico da api
$braziliex_volume = $databrzx['baseVolume'];
$braziliex_price = intval($braziliex_price); //transforma em numero
$braziliex_volume = intval($braziliex_volume);
$varbraziliex = $braziliex_price * $braziliex_volume;


//bitcointrade
$json_bitcointrade = file_get_contents("https://api.bitcointrade.com.br/v1/public/BTC/ticker");
$data_bitcoin_trade = json_decode($json_bitcointrade, true);
$bitcointrade_price = $data_bitcoin_trade['data']['last'];
$bitcointrade_volume = $data_bitcoin_trade['data']['volume'];
$bitcointrade_price = intval($bitcointrade_price);
$bitcointrade_volume = intval($bitcointrade_volume);
$varbitcointrade = $bitcointrade_price * $bitcointrade_volume;

//walltime
$json_walltime = file_get_contents("https://s3.amazonaws.com/data-production-walltime-info/production/dynamic/walltime-info.json");
$datawalltime = json_decode($json_walltime, true);
$walltime_price = $datawalltime['BRL_XBT']['last_inexact'];
$walltime_volume = $datawalltime['BRL_XBT']['quote_volume24h_inexact'];
$walltime_price = intval($walltime_price);
$walltime_volume = intval($walltime_volume);
$varwalltime = $walltime_price * $walltime_volume;

//bitcointoyou
$json_bitcointoyou = file_get_contents("https://www.bitcointoyou.com/api/ticker.aspx");
$databitcointoyou = json_decode($json_bitcointoyou, true);
$bitcointoyou_price = $databitcointoyou['ticker']['last'];
$bitcointoyou_volume = $databitcointoyou['ticker']['vol'];
$bitcointoyou_price = intval($bitcointoyou_price);
$bitcointoyou_volume = intval($bitcointoyou_volume);
$varbitcointoyou = $bitcointoyou_price * $bitcointoyou_volume;


//Calcula o preco medio ponderado
$var_media = $varbraziliex + $varbitcointrade + $varwalltime + $varbitcointoyou; //soma todas as variaveis
$volumetotal = $braziliex_volume + $bitcointrade_volume + $walltime_volume + $bitcointoyou_volume; //soma todos os volumes
$preco_ponderado = $var_media / $volumetotal; //calcula o preco medio ponderado
$preco_ponderado = intval($preco_ponderado); //arredonda o numero
//echo "o preço médio ponderado é R$:", number_format($preco_ponderado, 2, ',', '.');
include 'view/home.html';
?>