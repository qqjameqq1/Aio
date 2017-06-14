<?php
return [
	'TestMode'   => env('Ecpay_TestMode', true),
	'ServiceURL' => env('Ecpay_ServiceURL', 'https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5'),
	'HashKey' => env('Ecpay_HashKey', '5294y06JbISpM5x9'),
	'HashIV' => env('Ecpay_HashIV', 'v77hoKGq4kWxNNIS'),
	'MerchantID' => env('Ecpay_MerchantID', '2000132'),
];