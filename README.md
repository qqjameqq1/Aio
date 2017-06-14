## Aio
### Aio - Laravel 5 version
It is a fork from [ScottChayaa/Allpay](https://github.com/ScottChayaa/Allpay) package

#### step 1 : Download the package
composer命令安裝
```
composer require kevin50406418/aio
```
或者是新增package至composer.json
```
"require": {
  "kevin50406418/aio": "^1.0.0"
},
```
然後更新安裝
```
composer update
```
或全新安裝
```
composer install
```

#### step 2 : Modify config file
增加`config/app.php`中的`providers`和`aliases`的參數，依需求加上

Allpay:
```
'providers' => [
  // ...
  Kevin50406418\Aio\AllpayServiceProvider::class,
]

'aliases' => [
  // ...
  'Allpay' => Kevin50406418\Aio\Facade\Allpay::class,
]
```

Ecpay:
```
'providers' => [
  // ...
  Kevin50406418\Aio\EcpayServiceProvider::class,
]

'aliases' => [
  // ...
  'Allpay' => Kevin50406418\Aio\Facade\Ecpay::class,
]
```

<br>
#### step 3 : Publish config to your project
執行下列命令，將package的config檔配置到你的專案中

Allpay:
```
php artisan vendor:publish --provider=Kevin50406418\Aio\AllpayServiceProvider
```

Ecpay:
```
php artisan vendor:publish --provider=Kevin50406418\Aio\EcpayServiceProvider
```

可至config/allpay.php 或 config/ecpay.php中查看
預設是測試Allpay/Ecpay設定
```php
return [
    'ServiceURL' => 'http://payment-stage.allpay.com.tw/Cashier/AioCheckOut',
    'HashKey'    => '5294y06JbISpM5x9',
    'HashIV'     => 'v77hoKGq4kWxNNIS',
    'MerchantID' => '2000132',
];
```


---

### How To Use (for Allpay)
```php
use Allpay;
```
```php
public function Demo()
{
    //Official Example : 
    //https://github.com/allpay/PHP/blob/master/AioSDK/example/sample_Credit_CreateOrder.php
    
    //基本參數(請依系統規劃自行調整)
    Allpay::i()->Send['ReturnURL']         = "http://www.allpay.com.tw/receive.php" ;
    Allpay::i()->Send['MerchantTradeNo']   = "Test".time() ;           //訂單編號
    Allpay::i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');      //交易時間
    Allpay::i()->Send['TotalAmount']       = 2000;                     //交易金額
    Allpay::i()->Send['TradeDesc']         = "good to drink" ;         //交易描述
    Allpay::i()->Send['ChoosePayment']     = \PaymentMethod::ALL ;     //付款方式

    //訂單的商品資料
    array_push(Allpay::i()->Send['Items'], array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000",
               'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));

    //Go to AllPay
    echo "歐付寶頁面導向中...";
    echo Allpay::i()->CheckOutString();
}
```
用laravel的人開發盡量使用`CheckOutString()`回傳String的方法<br>
當然使用`CheckOut()`也是可以<br>
但如果使用的話，我猜後面可能會碰到Get不到特定Session的問題<br>

歐付寶回傳頁面時會使用到這個方法<br>
使用方法 ex: 
```php
public function PayReturn(Request $request)
{
    /* 取得回傳參數 */
    $arFeedback = Allpay::i()->CheckOutFeedback($request->all());
    //...
}
```
注意要傳入`$request->all()`<br>
因為官方原本的方法是帶入`$_POST` → Laravel 5 不鳥你這個，所以會出錯<br>
固做此修正<br>
不過這部分沒有多做說明，留給大家試試看<br>
<br>
