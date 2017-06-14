<?php

namespace Kevin50406418\Aio;


class AllpayFactory extends \AllInOne
{
	//取得付款結果通知的方法
	function CheckOutFeedback($allPost = null)
	{
		if ($allPost == null) $allPost = $_POST;

		return $arFeedback = \CheckOutFeedback::CheckOut(array_merge($allPost, array('EncryptType' => $this->EncryptType)), $this->HashKey, $this->HashIV);
	}

	//產生訂單
	function CheckOut($target = "_self")
	{
		$arParameters = array_merge(array('MerchantID' => $this->MerchantID, 'EncryptType' => $this->EncryptType), $this->Send);
		AllpaySend::CheckOut($target, $arParameters, $this->SendExtend, $this->HashKey, $this->HashIV, $this->ServiceURL);
	}

	//產生訂單html code
	function CheckOutString($paymentButton = null, $target = "_self")
	{
		$arParameters = array_merge(array('MerchantID' => $this->MerchantID, 'EncryptType' => $this->EncryptType), $this->Send);

		return AllpaySend::CheckOutString($paymentButton, $target = "_self", $arParameters, $this->SendExtend, $this->HashKey, $this->HashIV, $this->ServiceURL);
	}
}