<?php
include_once("../vendor/autoload.php");
use ThaiPromptpay\PromptpayQR;

class TestPromptpay extends PHPUnit_Framework_TestCase
{

    var $promptpay;
    
    public function setup()
    {
        $this->promptpay = new PromptpayQR;
    }

    public function testDefaultAmount()
    {
        $expected = '109.50';
        $this->assertEquals($expected, $this->promptpay->amount);
    }

    public function testAmount200p50()
    {
        $expected = '200.50';
        $this->promptpay->setAmount(200.50);
        $this->assertEquals($expected, $this->promptpay->amount);
    }

    public function testAmountZero()
    {
        $expected = '0';
        $this->promptpay->setAmount(0);
        $this->assertEquals($expected, $this->promptpay->amount);
    }
    
    public function testDefaultDataExcludeChecksum()
    {
        $expected = '00020101021129370016A000000677010111011300668399999995802TH53037646304';
        $this->promptpay->setAmount(0);
        $this->assertEquals($expected, $this->promptpay->generateQR());
    }
    
    public function testDefaultData()
    {
        $expected = '00020101021129370016A000000677010111011300668399999995802TH5303764630478A3';
        $this->promptpay->setAmount(0);
        $this->assertEquals($expected, $this->promptpay->generateQRwithChecksum());
    }
    
    public function testDefaultDataWithAmountExcludeChecksum()
    {
        $expected = '00020101021129370016A000000677010111011300668399999995802TH5406109.5053037646304';
        $this->promptpay->setAmount(109.50);
        $this->assertEquals($expected, $this->promptpay->generateQR());
    }

    public function testDefaultDataWithAmount()
    {
        $expected = '00020101021129370016A000000677010111011300668399999995802TH5406109.50530376463040779';
        $this->promptpay->setAmount(109.50);
        $this->assertEquals($expected, $this->promptpay->generateQRwithChecksum());
    }

    public function testDefaultDataWithAmountOnlyChecksum()
    {
        $expected = '0779';
        $this->promptpay->qrData = '00020101021129370016A000000677010111011300668399999995802TH5406109.5053037646304';
        $this->assertEquals($expected, $this->promptpay->generateCheckSum());
    }

    public function testDefaultDataOnlyChecksum()
    {
        $expected = '78A3';
        $this->promptpay->qrData = '00020101021129370016A000000677010111011300668399999995802TH53037646304';
        $this->assertEquals($expected, $this->promptpay->generateCheckSum());
    }

    public function testCitizenIDDataWithAmountExcludeChecksum()
    {
        $expected = '00020101021129370016A000000677010111021344199282855425802TH5406200.5053037646304';
        $this->promptpay->setPromptpayType('02');
        $this->promptpay->setPromptpayID('4419928285542');
        $this->promptpay->setAmount(200.50);
        $this->assertEquals($expected, $this->promptpay->generateQR());
    }

    public function testCitizenIDDataWithAmount()
    {
        $expected = '00020101021129370016A000000677010111021344199282855425802TH5406200.50530376463047BC3';
        $this->promptpay->setPromptpayType('02');
        $this->promptpay->setPromptpayID('4419928285542');
        $this->promptpay->setAmount(200.50);
        $this->assertEquals($expected, $this->promptpay->generateQRwithChecksum());
    }
}
