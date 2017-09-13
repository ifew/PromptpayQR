<?php
namespace ThaiPromptpay;
include_once("vendor/autoload.php");
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;
use Crc16CCIT\Crc16CCIT;

class Promptpay
{
    var $prefixVersion = '0002';
    var $version = '01'; //fixed
    var $prefixSellType = '0102';
    var $sellType = '11'; //11 multiple, 12 only bill
    var $prefixMerchant = '2937';
    var $prefixMerchantApplicationId = '0016';
    var $merchantApplicationId = 'A000000677010111';
    var $merchantPromptpayType = '01'; //01 mobile, 02 citizen id
    var $prefixMerchantPromptpayId = '13';
    var $merchantPromptpayId = '0066839999999'; // mobile start with 00 and 66 and number not start with 0, citizen use full length
    var $prefixCountryId = '5802';
    var $countryId = 'TH';
    var $prefixAmount = '5406';
    var $amount = '109.50';
    var $prefixCurrencyId = '5303';
    var $currencyId = '764'; //THB (ISO 4217)
    var $prefixChecksum = '6304';
    var $checksum;
    var $polynomial = '0x1021';
    var $crc = '0xFFFF';
    
    var $qrData;
    var $qrChecksum;

    function setPromptpayType($type) {
        $this->merchantPromptpayType = $type;
    }

    function setPromptpayID($id) {
        $this->merchantPromptpayId = $id;
    }

    function setAmount($amount) {
        $this->amount = number_format(round($amount, 2), 2);
    }

    function getQR() {
        $qrcode = new BaconQrCodeGenerator;
        return $qrcode->size(500)->generate($this->generateQRwithChecksum());
    }

    function generateCheckSum()
    {
        $cs = new Crc16CCIT();
        $checksumResult = $cs->calculate($this->qrData);

        if (strlen($checksumResult) < 4) {
            $checksumResult = '0'.$checksumResult;
        }

        return strtoupper($checksumResult);
    }

    function generateQR()
    {
        if(empty($this->amount) || ($this->amount == 0.00)) {
            $this->prefixAmount = '';
            $this->amount = '';
        }

        return $this->prefixVersion.$this->version.
            $this->prefixSellType.$this->sellType.
            $this->prefixMerchant.$this->prefixMerchantApplicationId.$this->merchantApplicationId.
            $this->merchantPromptpayType.$this->prefixMerchantPromptpayId.$this->merchantPromptpayId.
            $this->prefixCountryId.$this->countryId.
            $this->prefixAmount.$this->amount.
            $this->prefixCurrencyId.$this->currencyId.
            $this->prefixChecksum;
    }

    function generateQRwithChecksum()
    {
        $this->qrData = $this->generateQR();
        $qrChecksum = $this->generateCheckSum($this->qrData);

        return $this->qrData.$qrChecksum;
    }
}
