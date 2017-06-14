<?php

namespace Kevin50406418\Aio;

use Kevin50406418\Aio\AllpayFactory;

class Allpay
{

	private $instance = null;

	//--------------------------------------------------------

	public function __construct()
	{
		$this->instance = new AllpayFactory();
		$this->instance->EncryptType = \EncryptType::ENC_SHA256;

		config('allpay.TestMode') ? $this->setForTest() : $this->setForProd();
	}

	public function instance()
	{
		return $this->instance;
	}

	public function i()
	{
		return $this->instance;
	}

	private function setForTest()
	{
		$this->instance->ServiceURL = 'https://payment-stage.allpay.com.tw/Cashier/AioCheckOut/V4';
		$this->instance->HashKey = '5294y06JbISpM5x9';
		$this->instance->HashIV = 'v77hoKGq4kWxNNIS';
		$this->instance->MerchantID = '2000132';
	}

	private function setForProd()
	{
		$this->instance->ServiceURL = config('allpay.ServiceURL');
		$this->instance->HashKey = config('allpay.HashKey');
		$this->instance->HashIV = config('allpay.HashIV');
		$this->instance->MerchantID = config('allpay.MerchantID');
	}

}
