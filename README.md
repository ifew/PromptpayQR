# php-promptpay
PHP generate PrompPay QR Code for pay on Thailand Banking application

# Install
- run "composer install"
- test via "index.php"

# Usage
<?php
include_once("vendor/autoload.php");
use ThaiPromptpay\Promptpay;

$qr = new Promptpay;
$qr->setPromptpayType('02');
$qr->setPromptpayID('4419928285542');
$qr->setAmount(200.50);
echo $qr->getQR();
?>

# QR Code try on
- http://www.qr-code-generator.com/

# Thank You
 - Crc16CCIT https://github.com/jkobus/crc16-ccit

# Reference
- https://www.blognone.com/node/95133
- https://qr-generator.digio.co.th/
- https://github.com/wannaphongcom/pypromptpay
