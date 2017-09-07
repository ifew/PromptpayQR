<?php
include "../Promptpay.php";

class TestPromptpay extends PHPUnit_Framework_TestCase {

	var $promptpay;
	
	public function setup() {
		$this->promptpay = new Promptpay();
	}
	
	public function testDefaultDataExcludeChecksum() {
		$expected = '00020101021129370016A000000677010111011300668399999995802TH53037646304';
		$this->assertEquals($expected, $this->promptpay->generateQRData());
	}
	
	public function testDefaultData() {
		$expected = '00020101021129370016A000000677010111011300668399999995802TH5303764630478A3';
		$this->assertEquals($expected, $this->promptpay->generateQRPlainText());
	}
	
	public function testDefaultDataExcludeChecksumWithAmount() {
		$expected = '00020101021129370016A000000677010111011300668399999995802TH5406109.5053037646304';
		$this->assertEquals($expected, $this->promptpay->generateQRDataWithAmount());
	}

	public function testDefaultDataWithAmount() {
		$expected = '00020101021129370016A000000677010111011300668399999995802TH5406109.50530376463040779';
		$this->assertEquals($expected, $this->promptpay->generateQRWithAmountPlainText());
	}
}

