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


	//訂單查詢作業
	function QueryTradeInfo() {
		return $arFeedback = \QueryTradeInfo::CheckOut(array_merge($this->Query,array("MerchantID" => $this->MerchantID, 'EncryptType' => $this->EncryptType)) ,$this->HashKey ,$this->HashIV ,$this->ServiceURL) ;
	}

	//信用卡定期定額訂單查詢的方法
	function QueryPeriodCreditCardTradeInfo() {
		return $arFeedback = \QueryPeriodCreditCardTradeInfo::CheckOut(array_merge($this->Query,array("MerchantID" => $this->MerchantID, 'EncryptType' => $this->EncryptType)) ,$this->HashKey ,$this->HashIV ,$this->ServiceURL);
	}

	//信用卡關帳/退刷/取消/放棄的方法
	function DoAction() {
		return $arFeedback = \DoAction::CheckOut(array_merge($this->Action,array("MerchantID" => $this->MerchantID, 'EncryptType' => $this->EncryptType)) ,$this->HashKey ,$this->HashIV ,$this->ServiceURL);
	}

	//廠商通知退款
	function AioChargeback() {
		return $arFeedback = \AioChargeback::CheckOut(array_merge($this->ChargeBack,array("MerchantID" => $this->MerchantID, 'EncryptType' => $this->EncryptType)) ,$this->HashKey ,$this->HashIV ,$this->ServiceURL);
	}

	//會員申請撥款／退款
	function AioCapture(){
		return $arFeedback = \AioCapture::Capture(array_merge($this->Capture,array("MerchantID" => $this->MerchantID, 'EncryptType' => $this->EncryptType)) ,$this->HashKey ,$this->HashIV ,$this->ServiceURL);
	}

	//下載會員對帳媒體檔
	function TradeNoAio($target = "_self"){
		$arParameters = array_merge( array('MerchantID' => $this->MerchantID, 'EncryptType' => $this->EncryptType) ,$this->TradeNo);
		\TradeNoAio::CheckOut($target,$arParameters,$this->HashKey,$this->HashIV,$this->ServiceURL);
	}

	//查詢信用卡單筆明細紀錄
	function QueryTrade(){
		return $arFeedback = \QueryTrade::CheckOut(array_merge($this->Trade,array("MerchantID" => $this->MerchantID, 'EncryptType' => \EncryptType::ENC_SHA256)) ,$this->HashKey ,$this->HashIV ,$this->ServiceURL);
	}

	//下載信用卡撥款對帳資料檔
	function FundingReconDetail($target = "_self"){
		$arParameters = array_merge( array('MerchantID' => $this->MerchantID, 'EncryptType' => $this->EncryptType) ,$this->Funding);
		\FundingReconDetail::CheckOut($target,$arParameters,$this->HashKey,$this->HashIV,$this->ServiceURL);
	}
}