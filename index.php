<?php
include_once("vendor/autoload.php");
use ThaiPromptpay\PromptpayQR;

$qr = new PromptpayQR;
$qr->setPromptpayType('02');
$qr->setPromptpayID('4419928285542');
$qr->setAmount(200.50);
echo $qr->getQR();
?>