<?php

namespace Kevin50406418\Aio;

class EcpayFactory extends \ECPay_AllInOne
{
	//產生訂單
	public function CheckOutString($paymentButton = null, $target = "_self")
	{
		$arParameters = array_merge(array('MerchantID' => $this->MerchantID, 'EncryptType' => $this->EncryptType), $this->Send);

		return EcpaySend::CheckOutString($paymentButton, $target = "_self", $arParameters, $this->SendExtend, $this->HashKey, $this->HashIV, $this->ServiceURL);
	}

	//取得付款結果通知的方法
	public function CheckOutFeedback($ecpayPost = null)
	{
		$ecpayPost = $ecpayPost ? $ecpayPost : $_POST;

		return $arFeedback = \ECPay_CheckOutFeedback::CheckOut(array_merge($ecpayPost, array('EncryptType' => $this->EncryptType)), $this->HashKey, $this->HashIV);
	}

}