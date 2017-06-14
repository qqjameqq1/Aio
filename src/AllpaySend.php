<?php

namespace Kevin50406418\Aio;


class AllpaySend extends \Send
{
	static function CheckOutString($paymentButton, $target = "_self", $arParameters = array(), $arExtend = array(), $HashKey = '', $HashIV = '', $ServiceURL = '')
	{

		$arParameters = self::process($arParameters, $arExtend);
		//產生檢查碼
		$szCheckMacValue = \CheckMacValue::generate($arParameters, $HashKey, $HashIV, $arParameters['EncryptType']);

		$szHtml = "<form id=\"__allpayForm\" method=\"post\" target=\"{$target}\" action=\"{$ServiceURL}\">";
		foreach ($arParameters as $keys => $value) {
			$szHtml .= "<input type=\"hidden\" name=\"{$keys}\" value='{$value}'>";
		}
		$szHtml .= "<input type=\"hidden\" name=\"CheckMacValue\" value=\"{$szCheckMacValue}\" />";
		if (!isset($paymentButton)) {
			$szHtml .= '<script type="text/javascript">document.getElementById("__allpayForm").submit();</script>';
		} else {
			$szHtml .= "<input type=\"submit\" id=\"__paymentButton\" value=\"{$paymentButton}\" />";
		}
		$szHtml .= '</form>';

		return $szHtml;
	}
}