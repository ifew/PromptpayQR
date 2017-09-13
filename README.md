# PromptpayQR
PHP generate PrompPay QR Code for pay on Thailand Banking application

# Install
get library QR Generator
- run `composer install`

# Usage

    <?php
    include_once("vendor/autoload.php");
    use ThaiPromptpay\PromptpayQR;
    
    $qr = new PromptpayQR;
    $qr->setPromptpayType('02');
    $qr->setPromptpayID('4419928285542');
    $qr->setAmount(200.50);
    echo $qr->getQR();
    ?>

# Function Reference
### setPromptpayType()
set type of Promptpay ID
- 01 = Mobile Number
- 02 = Citizen ID

### setPromptpayID()
set Promptpay ID
- for Citizen ID, Using full length of Citizen (13 Characters) and only number such as `1234567890123`
- for Mobile ID, Start with "00" and Number of Country Code "66" and Mobile Phone Number exclude zero prefixes such as `0066831234567`

### setAmount()
set amount of money for pay
- if have amount, Using digit and 2 decimals such as `199.50`
- if not want to amount, Using `0`

### getQR()
Display QR Image

### generateQRwithChecksum()
Display raw text of your pay code (this code use for generating to QR Code)

# QR Code try on
- http://www.qr-code-generator.com/

# Thank You
 - Crc16CCIT https://github.com/jkobus/crc16-ccit

# Reference
- https://www.blognone.com/node/95133
- https://qr-generator.digio.co.th/
- https://github.com/wannaphongcom/pypromptpay
