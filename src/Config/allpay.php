<?php

return [
	'TestMode'   => env('Allpay_TestMode', true),
	'ServiceURL' => env('Allpay_ServiceURL', 'https://payment-stage.allpay.com.tw/Cashier/AioCheckOut/V4'),
	'HashKey'    => env('Allpay_HashKey', '5294y06JbISpM5x9'),
	'HashIV'     => env('Allpay_HashIV', 'v77hoKGq4kWxNNIS'),
	'MerchantID' => env('Allpay_MerchantID', '2000132'),

];
