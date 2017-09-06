<?php

class Promptpay {
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
    var $prefixCurrencyId = '5303';
    var $currencyId = '764'; //THB (ISO 4217)
    var $prefixCheckSum = '6304';
    var $checkSum;
    var $polynomial = '0x1021';
    var $crc = '0xFFFF';

    function generateCheckSum($qrData) {
        include_once("CRC16CCIT.php");
        $cs = new Crc16CCIT();
        $checksum = $cs->calculate($qrData);
        return strtoupper($checksum);
    }

    function generateQRData() {
        $qrData = $this->prefixVersion.$this->version.
            $this->prefixSellType.$this->sellType.
            $this->prefixMerchant.$this->prefixMerchantApplicationId.$this->merchantApplicationId.
            $this->merchantPromptpayType.$this->prefixMerchantPromptpayId.$this->merchantPromptpayId.
            $this->prefixCountryId.$this->countryId.
            $this->prefixCurrencyId.$this->currencyId.
            $this->prefixCheckSum;

        return $qrData;
    }

    function generateQRPlainText() {
        $qrData = $this->generateQRData();
        $qrCheckSum = $this->generateCheckSum($qrData);

        return $qrData.$qrCheckSum;
    }
}