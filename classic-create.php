<?php
date_default_timezone_set("Asia/Bangkok");

$unik = date('Hi');
$unik2 = substr(str_shuffle(1234567890), 0, 3);
$merchantRef  = 'ZEP' . $unik . $unik2;

$apiKey       = 'DEV-wghbixSwNv5rgLogBz8xWCFZsmZdRrzJeCOBEOqg';
$privateKey   = 'u5yvB-yFPyn-xQvkD-DfxwK-ZW2fW';
$merchantCode = 'T19767';

		 $email = $_POST["email"];
		 $password = $_POST["password"];		 
		 $id_akun = $_POST["id_akun"];
		 $id_server = $_POST["id_server"];
		 $akun = $id_akun . ' (' . $id_server . ')';
		 $nickname = $_POST["nickname"];
		 $login_type = $_POST["login_type"];
		 $min_hero = $_POST["min_hero"];
		 $payment = $_POST["payment"];
		 $whatsapp = $_POST["whatsapp"];
		 $voucher = $_POST["voucher"];
		 $price =  $_POST["price"];
		 $dj_label =  $_POST["dj_label"];
		 $note =  $_POST["note"];
		 $qty =  $_POST["qty"];
		 $amount = $price * $qty;


$data = [
    'method'         => $payment,
    'merchant_ref'   => $merchantRef,
    'amount'         => $amount,
    'customer_name'  => $login_type." ".$nickname,
    'customer_email' => $email,
    'customer_phone' => $whatsapp,
    'order_items'    => [
        [
            'sku'         => $dj_label,
            'name'        => $min_hero."-".$note,
            'price'       => $price,
            'quantity'    => $qty,
            'product_url' => 'http://zukmastore.epizy.com/diamond',
            'image_url'   => 'http://zukmastore.epizy.com/assets/logo.png',
        ]
    ],
    'return_url'   => 'http://zukmastore.epizy.com/diamond',
    'expired_time' => (time() + (1 * 60 * 60)), // 1 jam
    'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_FRESH_CONNECT  => true,
    CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER         => false,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
    CURLOPT_FAILONERROR    => false,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => http_build_query($data),
    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
]);

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

echo empty($error) ? $response : $error;
$api = json_decode($response, true);

if($payment == "MYBVA"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/ZT91lrOEad1582929126.png';
}elseif($payment == "PERMATAVA"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/szezRhAALB1583408731.png';
}elseif($payment == "BNIVA"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/n22Qsh8jMa1583433577.png';
	}elseif($payment == "BRIVA"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/8WQ3APST5s1579461828.png';
	}elseif($payment == "MANDIRIVA"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/T9Z012UE331583531536.png';
	}elseif($payment == "SMSVA"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/KHcqcmqVFQ1607091889.png';
	}elseif($payment == "CIMBVA"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/WtEJwfuphn1614003973.png';
	}elseif($payment == "HANAVAOP"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/ml13c9N7hk1631608749.png';
	}elseif($payment == "BSIVA"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/tEclz5Assb1643375216.png';
}elseif($payment == "INDOMARET"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/zNzuO5AuLw1583513974.png';
}elseif($payment == "ALFAMART"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/jiGZMKp2RD1583433506.png';
}elseif($payment == "ALFAMIDI"){
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/aQTdaUC2GO1593660384.png';
}else{
	$iconbayar = 'https://assets.tripay.co.id/upload/payment-icon/3IXRIbogu11664370160.png';
}

$invoice = $api['data']['merchant_ref'];
$bayar = $api['data']['payment_name'];
$status = $api['data']['status'];
$kodebayar = $api['data']['pay_code'];
$camount = $api['data']['amount'];
$qriscs = $api['data']['qr_string'];
$famount = number_format($camount , 0, ',', '.');
$tanggal = date('d-m-Y H:i');

$qriszukma = <<<HTMLBARUA
<!DOCTYPE HTML>
<html lang="en">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"> 
  <title>$invoice</title> 
  <meta name="title" content="$invoice> 
  <meta name="description" content="Cari paling mudah Top Up Diamond di Zukma Store dengan Harga yang Terjangkau"> 
  <meta property="og:type" content="website"> 
  <meta property="og:url" content="https://zukmastore.epizy.com/c/PJ62ZOVVAU"> 
  <meta property="og:title" content="$invoice> 
  <meta property="og:description" content="Cari paling mudah Top Up Diamond di Zukma Store dengan Harga yang Terjangkau"> 
  <meta property="og:image" content="https://zukmastore.epizy.com//assets/logo_bg.png"> 
  <meta property="twitter:card" content="summary_large_image"> 
  <meta property="twitter:url" content="https://zukmastore.epizy.com/c/PJ62ZOVVAU"> 
  <meta property="twitter:title" content="$invoice> 
  <meta property="twitter:description" content="Cari paling mudah Top Up Diamond di Zukma Store dengan Harga yang Terjangkau"> 
  <meta property="twitter:image" content="https://zukmastore.epizy.com//assets/logo_bg.png"> 
  <link rel="shortcut icon" href="https://zukmastore.epizy.com/assets/logo.png" type="image/svg"> 
  <link rel="stylesheet" type="text/css" href="https://zukmastore.epizy.com/assets/template/bootstrap.css"> 
  <link rel="stylesheet" type="text/css" href="https://zukmastore.epizy.com/assets/template/bootstrap-icons.css"> 
  <link rel="stylesheet" type="text/css" href="https://zukmastore.epizy.com/assets/template/select2.min.css"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> 
  <link rel="stylesheet" href="https://zukmastore.epizy.com/assets/wa/venom-button.min.css"> 
  <link rel="preconnect" href="https://fonts.gstatic.com"> 
  <link href="https://zukmastore.epizy.com/cloudme.fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&amp;family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"> 
  <meta id="theme-check" name="theme-color" content="#FFFFFF"> 
  <link rel="apple-touch-icon" sizes="180x180" href="https://paypalku.com/assets/logo.png"> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
  <script>const _0x3931d7=_0x25c3;(function(_0x5e2ffe,_0x1f9f6a){const _0x4cf37e=_0x25c3,_0xae4b79=_0x5e2ffe();while(!![]){try{const _0x130ce4=parseInt(_0x4cf37e(0x91))/0x1+parseInt(_0x4cf37e(0x9b))/0x2*(-parseInt(_0x4cf37e(0x96))/0x3)+parseInt(_0x4cf37e(0x9a))/0x4*(parseInt(_0x4cf37e(0xa6))/0x5)+-parseInt(_0x4cf37e(0x8d))/0x6*(-parseInt(_0x4cf37e(0x90))/0x7)+-parseInt(_0x4cf37e(0xb0))/0x8*(-parseInt(_0x4cf37e(0xa0))/0x9)+parseInt(_0x4cf37e(0x93))/0xa*(-parseInt(_0x4cf37e(0x8e))/0xb)+-parseInt(_0x4cf37e(0xa8))/0xc;if(_0x130ce4===_0x1f9f6a)break;else _0xae4b79['push'](_0xae4b79['shift']());}catch(_0x5cbf4c){_0xae4b79['push'](_0xae4b79['shift']());}}}(_0x5919,0x57bbb));function formatRupiah(_0xf3394d,_0x4f081c=_0x3931d7(0xae)){const _0x768c77=_0x3931d7;_0xf3394d=String(_0xf3394d);var _0x7c80d6=_0xf3394d[_0x768c77(0xa2)](/[^,\d]/g,'')[_0x768c77(0xaf)](),_0x3884bd=_0x7c80d6[_0x768c77(0xac)](','),_0x1c3db3=_0x3884bd[0x0]['length']%0x3,_0x273f02=_0x3884bd[0x0][_0x768c77(0x92)](0x0,_0x1c3db3),_0x12403c=_0x3884bd[0x0]['substr'](_0x1c3db3)[_0x768c77(0xad)](/\d{3}/gi);return _0x12403c&&(separator=_0x1c3db3?'.':'',_0x273f02+=separator+_0x12403c[_0x768c77(0xa3)]('.')),_0x273f02=_0x3884bd[0x1]!=undefined?_0x273f02+','+_0x3884bd[0x1]:_0x273f02,_0x4f081c==undefined?_0x273f02:_0x273f02?_0x768c77(0x98)+_0x273f02:'';}function pembulatanRupiah(_0x5dc592){const _0x897e8e=_0x3931d7;var _0x4b8d60=_0x5dc592/0x3e8,_0x3836dd=Math[_0x897e8e(0x8c)](_0x4b8d60),_0x4bffd3=_0x3836dd*0x3e8;return _0x4bffd3;}function _0x5919(){const _0x5bd03e=['Rp.\x20','#href_pulsa','766244qfIHyf','102iySNzJ','#payment_select_icon_INDOMARET','#payment_select_icon_SHOPEEPAY','#payment_select_icon_ALFAMIDI','.payment_select_icon_va','1701MMffZE','#payment_select_icon_OVO','replace','join','#payment_label_store','#payment_select_icon_telkomsel','10nCTBLY','#href_store','11047428sGvzlo','html','#payment_label_va','hide','split','match','Rp\x20','toString','23200zQQikJ','#href_va','#payment_select_icon_byu','round','79878TYymLA','11fEVpOq','#payment_select_icon_three','308iHmfub','443993mudLCP','substr','4754830EjdSHm','#payment_SALDO','show','12090kurUgR','#payment_label_saldo'];_0x5919=function(){return _0x5bd03e;};return _0x5919();}function _0x25c3(_0x27942f,_0x461455){const _0x5919b3=_0x5919();return _0x25c3=function(_0x25c360,_0x3a3467){_0x25c360=_0x25c360-0x8b;let _0x4d6749=_0x5919b3[_0x25c360];return _0x4d6749;},_0x25c3(_0x27942f,_0x461455);}function changePaymentValidate(_0x67ae74){const _0x30c252=_0x3931d7;_0x67ae74=parseInt(_0x67ae74);let _0x59c15d=0x109a,_0x5d86ea=0xdac,_0x3482ae=0x1770,_0x29f58b=0x1770,_0xdb9aa4=2.9,_0xd7a21f=0x3,_0x14dbd2=0x3,_0xbaa719=38.2,_0xd34176=38.2,_0x2e3168=38.2,_0x3c8103=38.2,_0x4d7a71=38.2,_0x467734=_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xdb9aa4/0x64),_0x2ec5a5=_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xd7a21f/0x64),_0x47c742=_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0x14dbd2/0x64),_0x238bb5=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xbaa719/0x64)),_0x42fdc6=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xd34176/0x64)),_0xadf354=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0x2e3168/0x64)),_0x47af75=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0x3c8103/0x64)),_0x16c0c7=pembulatanRupiah(_0x67ae74+Math['round'](_0x67ae74*_0x4d7a71/0x64)),_0x35b0a6=_0x59c15d+_0x67ae74,_0x49acd3=_0x5d86ea+_0x67ae74,_0x153a35=_0x3482ae+_0x67ae74,_0x376eaf=_0x29f58b+_0x67ae74,_0x370b77=_0x67ae74;_0x67ae74<=0x76c?($(_0x30c252(0xb1))[_0x30c252(0xab)](),$('#href_wallet')['show'](),$(_0x30c252(0x94))['show'](),$(_0x30c252(0xa7))[_0x30c252(0xab)](),$(_0x30c252(0x99))[_0x30c252(0xab)]()):(_0x67ae74>=0x16e360?$(_0x30c252(0x99))[_0x30c252(0xab)]():$(_0x30c252(0x99))[_0x30c252(0x95)](),$(_0x30c252(0xb1))[_0x30c252(0x95)](),$('#href_wallet')[_0x30c252(0x95)](),$(_0x30c252(0xa7))[_0x30c252(0x95)](),$(_0x30c252(0x94))[_0x30c252(0x95)]()),$(_0x30c252(0x97))[_0x30c252(0xa9)](formatRupiah(_0x370b77)),$(_0x30c252(0xaa))['html'](formatRupiah(_0x35b0a6)),$('#payment_label_wallet')[_0x30c252(0xa9)](formatRupiah(_0x467734)),$(_0x30c252(0xa4))[_0x30c252(0xa9)](formatRupiah(_0x49acd3)),$('#payment_label_pulsa')[_0x30c252(0xa9)](formatRupiah(_0x238bb5)),$(_0x30c252(0x9f))[_0x30c252(0xa9)](formatRupiah(_0x35b0a6)),$(_0x30c252(0x9c))['html'](formatRupiah(_0x49acd3)),$('#payment_select_icon_ALFAMART')[_0x30c252(0xa9)](formatRupiah(_0x153a35)),$(_0x30c252(0x9e))[_0x30c252(0xa9)](formatRupiah(_0x376eaf)),$(_0x30c252(0xa1))['html'](formatRupiah(_0x2ec5a5)),$(_0x30c252(0x9d))[_0x30c252(0xa9)](formatRupiah(_0x47c742)),$('#payment_select_icon_QRISC')[_0x30c252(0xa9)](formatRupiah(_0x467734)),$(_0x30c252(0xa5))[_0x30c252(0xa9)](formatRupiah(_0x238bb5)),$('#payment_select_icon_indosat')[_0x30c252(0xa9)](formatRupiah(_0x42fdc6)),$(_0x30c252(0x8f))[_0x30c252(0xa9)](formatRupiah(_0xadf354)),$('#payment_select_icon_xl_axis')[_0x30c252(0xa9)](formatRupiah(_0x47af75)),$(_0x30c252(0x8b))[_0x30c252(0xa9)](formatRupiah(_0x16c0c7));}</script> 
  <style>.no_card{padding:5px 10px 5px 10px;color:#fff;background-color:#00008B;border-radius:100px;margin-right:3px}.icon-img{box-shadow:0 0 10px 5px rgba(0,0,190,1);-webkit-box-shadow:0 0 10px 5px rgba(0,0,190,1);-moz-box-shadow:0 0 10px 5px rgba(0,0,190,1)}span.rise-shake{animation:jump-shaking .83s infinite}.rise-shake{animation:jump-shaking .83s infinite}@keyframes jump-shaking {
          0% { transform: translateX(0) }
          25% { transform: translateY(-9px) }
          35% { transform: translateY(-9px) rotate(17deg) }
          55% { transform: translateY(-9px) rotate(-17deg) }
          65% { transform: translateY(-9px) rotate(17deg) }
          75% { transform: translateY(-9px) rotate(-17deg) }
          100% { transform: translateY(0) rotate(0) }
        }</style> 
 </head> 
 <body class="theme-light" id="bodyhtml" style="background-image:url('https://i.ibb.co/yn6fgyg/Be-Funky-design-21.jpg')"> 
  <div id="preloader"> 
   <div class="spinner-border color-highlight" role="status"></div> 
  </div> 
  <div id="page"> 
   <div class="header-bar header-fixed header-app"> 
    <a data-back-button="" href="#"> <i class="bi bi-caret-left-fill font-11 color-theme ps-2"></i> </a> 
    <a href="#" class="header-title color-theme font-13">Lakukan Pembayaran</a> 
    <a onclick="location.reload()" href="#"> <i class="bi bi-arrow-clockwise font-13 color-highlight"></i> </a> 
    <a href="#" class="btn_theme show-on-theme-light" data-toggle-theme=""> <i class="bi bi-moon-fill font-13"></i> </a> 
    <a href="#" class="btn_theme show-on-theme-dark" data-toggle-theme=""> <i class="bi bi-moon-fill color-white font-13"></i> </a> 
   </div> 
   <div id="footer-bar" class="footer-bar footer-bar-detached"> 
    <a class="" href="https://zukmastore.epizy.com/invoice"> <i class="bi bi-search font-16"></i> <span>Check</span> </a> 
    <a href="https://zukmastore.epizy.com/spin-berhadiah"> <i class="bi bi-gift font-16 rise-shake"></i> <span>Hadiah</span> </a> 
    <a class="active-nav" href="https://zukmastore.epizy.com/"> <i class="bi bi-house-fill font-16"></i> <span>Home</span> </a> 
    <a href="https://zukmastore.epizy.com/tambang-diamond" class=""> <i class="bi bi-gem font-16"></i> <span>Gratis</span> </a> 
    <a class="" href="https://zukmastore.epizy.com/users"> <i class="bi bi-person font-16"></i> <span>Masuk</span> </a> 
   </div> 
   <div id="menu-main" style="width:280px;" class="offcanvas offcanvas-start offcanvas-detached rounded-m"> 
    <div> 
     <div class="card card-style mb-3 rounded-m mt-3" style="height: 150px;" data-card-height="150"> 
      <div class="card-top m-3"> 
       <a href="#" data-bs-dismiss="offcanvas" class="icon icon-xs bg-theme rounded-s color-theme float-end"> <i class="bi bi-caret-left-fill"></i> </a> 
      </div> 
      <div class="card-bottom p-3"> 
       <h1 class="color-white font-20 font-700 mb-n2"></h1> 
       <p class="color-white font-12 opacity-70 mb-n1"></p> 
      </div> 
      <div class="card-overlay rounded-0"></div> 
     </div> 
     <span class="menu-divider">APP</span> 
     <div class="menu-list"> 
      <div class="card card-style rounded-m p-3 py-2 mb-0"> 
       <a href="https://wa.me/6285733576022"> <i class="gradient-green shadow-bg shadow-bg-xs bi bi-whatsapp"></i> <span>Hubungi Admin</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/jual-beli-akun" id="nav-mails"> <i class="gradient-red shadow-bg shadow-bg-xs bi bi-controller"></i> <span>Jual / Beli Akun</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://www.google.com/maps/uv?pb=!1s0x2dd663f196095f87%3A0x138e73226fcdb6e9!5sZukma Store!15sCgIgAQ&amp;imagekey=!1e10!2sAF1QipPCEgAvT-Vij_8uiNvs3JTVorXU-egXFELQ9AbN" target="_blank" id="nav-mails"> <i class="gradient-yellow shadow-bg shadow-bg-xs bi bi-shop"></i> <span>Offline Store</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/testimoni" id="nav-mails"> <i style="background-color: #4267B2" class="shadow-bg shadow-bg-xs bi bi-cart-fill"></i> <span>Testimoni</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://play.google.com/store/apps/details?id=com.zukmastores" target="_blank" id="nav-mails"> <i class="gradient-blue shadow-bg shadow-bg-xs bi bi-phone-fill"></i> <span>Google Playstore</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/faq" id="nav-mails"> <i class="gradient-orange shadow-bg shadow-bg-xs bi bi-chat-dots"></i> <span>FAQ</span> <i class="bi bi-chevron-right"></i> </a> 
      </div> 
     </div> 
     <span class="menu-divider mt-4">Kalkulator</span> 
     <div class="menu-list"> 
      <div class="card card-style rounded-m p-3 py-2 mb-0"> 
       <a href="https://zukmastore.epizy.com/kalkulator-joki" id="nav-mails"> <i style="background-color: #4267B2" class="shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>Kalkulator Joki</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/hitung-wr" id="nav-mails"> <i class="gradient-green shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>Hitung WR</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/hp-magic-wheel" id="nav-mails"> <i class="gradient-blue shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>HP Magic Wheel</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/hp-zodiac" id="nav-mails"> <i class="gradient-orange shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>HP Zodiac</span> <i class="bi bi-chevron-right"></i> </a> 
      </div> 
     </div> 
     <span class="menu-divider mt-4">Bantuan &amp; Sosmed</span> 
     <div class="menu-list" style="margin-bottom: 50px"> 
      <div class="card card-style rounded-m p-3 py-2 mb-0"> 
       <a href="https://www.instagram.com/zukmastores/"> <i style="background-color: #e95950" class="shadow-bg shadow-bg-xs bi bi-instagram"></i> <span>Instagram</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://www.facebook.com/zukmastores"> <i style="background-color: #4267B2" class="shadow-bg shadow-bg-xs bi bi-facebook"></i> <span>Facebook</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://www.tiktok.com/@zukmastores"> <i style="background-color: #000" class="shadow-bg shadow-bg-xs bi bi-tiktok"></i> <span>TikTok</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/terms-conditions"> <i class="gradient-green shadow-bg shadow-bg-xs bi bi-clipboard-check"></i> <span>Terms &amp; Conditions</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/privacy-policy"> <i class="gradient-orange shadow-bg shadow-bg-xs bi bi-clipboard-check"></i> <span>Privacy Policy</span> <i class="bi bi-chevron-right"></i> </a> 
      </div> 
     </div> 
    </div> 
   </div> 
   <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-cs-header2" style="visibility: hidden;" aria-hidden="true"> 
    <div class="content mt-3"> 
     <div class="d-flex pb-2"> 
      <div class="align-self-center"> 
       <h1 class="font-700">Butuh Bantuan ?</h1> 
      </div> 
      <div class="align-self-center ms-auto"> 
       <a href="#" data-bs-dismiss="offcanvas" class="icon icon-m"> <i class="bi bi-x-circle-fill color-red-dark font-18 me-n4"></i> </a> 
      </div> 
     </div> 
     <div class="list-group list-custom list-group-m rounded-xs list-group-flush bg-theme"> 
      <a href="https://wa.me/6285854760492?text=" class="shareToWhatsApp list-group-item" target="_blank"> <i class="bi bi-whatsapp color-whatsapp font-16"></i> 
       <div>
        Customer Service 1
       </div> <i class="bi bi-chevron-right pe-1"></i> </a> 
      <br> 
      <br> 
      <br> 
     </div> 
    </div> 
   </div>
   <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script> 
   <div class="page-content header-clear-medium"> 
    <div class="card card-style mb-3"> 
     <div class="content"> 
      <div class="d-flex"> 
       <h5>{$dj_label}</h5> 
      </div> 
      <table class="table color-theme mb-2 mt-2"> 
       <tbody>
        <tr> 
         <td>ID Transaksi</td> 
         <td>: {$invoice} <span class="badge bg-primary ms-1" onclick="copy('{$invoice}')" data-toast="done">Salin</span></td> 
        </tr> 
        <tr> 
         <td>Tgl. Pembelian</td> 
         <td>: {$tanggal} WIB</td> 
        </tr> 
        <tr> 
         <td>ID Akun</td> 
         <td>: {$akun}</td> 
        </tr>
        <tr> 
         <td>Nickname</td> 
         <td>: {$nickname}</td> 
        </tr> 
        <tr id="diskon_tr"> 
         <td>Total Pembelian</td> 
         <th class="color-highlight">: Rp {$famount}</th> 
        </tr>
        <tr id="diskon_tr"> 
         <td>Status Pembayaran</td> 
         <th class="color-red-dark">: {$status}</th> 
        </tr> 
       </tbody>
      </table> 
     </div> 
    </div> 
    <div class="card card-style"> 
     <div class="content"> 
      <center> 
       <a style="color: #0d6efd" href="https://api.qrserver.com/v1/create-qr-code/?size=700x700&amp;data={$qriscs}"></a> </a> 
   <div id="qrcode" onclick="location = '#'">    </div> 
      </center> 
      <div class="list-group list-custom list-group-m"> 
       <a class="list-group-item" href="#qris" aria-controls="qris" data-bs-toggle="collapse" aria-expanded="true"> <i class="bi color-red-dark bi-qr-code"></i> 
        <div> 
         <strong>Cara Scan QRIS</strong> 
         <span>Tutorial Bayar QRIS dengan 1 HP</span> 
        </div> <span class="badge rounded-xl" style="background-color: #9d9d9d" id="payment_label_store"></span> </a> 
       <div id="qris" class="collapse" style=""> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           1. Screenshot Barcode/QR-Code di atas 
         </div> <span class="badge rounded-xl"></span> </a> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           2. Buka aplikasi E-wallet dan pilih Scan QRIS 
         </div> <span class="badge rounded-xl"></span> </a> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           3. Insert Image from Galery dan pilih gambar Barcode/QR-Code
         </div> <span class="badge rounded-xl"></span> </a> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           4. Lalu Bayar sesuai Nominal yang muncul 
         </div> <span class="badge rounded-xl"></span> </a> 
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="card card-style"> 
     <div class="content"> 
      <div class="row"> 
       <div class="col-9"> 
        <span><i class="bi bi-clock" style="margin-right: 5px;"></i> Silahkan selesaikan pembayaran kamu dalam</span> 
       </div> 
       <div class="col-3"> 
        <h6 style="text-align: right;" class="font-14" id="countdown">00:00</h6> 
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="row mt-4" style="margin-right: 30px; margin-left: 30px; margin-bottom: 50px;"> 
     <a href="#" onclick="location.reload()" class="btn-full btn gradient-red mb-4">Saya Sudah Bayar</a> 
     <center>
       Dengan melanjutkan, Kamu setuju dengan 
      <b class="color-highlight"><a href="https://zukmastore.epizy.com/terms-conditions" target="_blank">Syarat dan Ketentuan</a></b> dan juga 
      <b class="color-highlight"><a href="https://zukmastore.epizy.com/privacy-policy" target="_blank">Kebijakan Privasi</a></b> Zukma Store. 
     </center> 
    </div> 
   </div> 
   <script>
    $("#btn_submit").on('click', e => {

		const payment = $("#payment").val()
		if(payment === ''){
		    
		    $("#notification-danger").addClass('show')
			$("#notification-title").html('Error')
			$("#notification-desc").html("Silahkan pilih metode pembayaran terlebih dahulu")
		}else{
    		location = 'https://zukmastore.epizy.com/change-payment/PJ62ZOVVAU/' + payment
		}
	})

	function changePayment(id, label){

		const payment = $("#payment").val()

		if(payment !== ''){

			$("#payment_select_"+payment).html('')
		}

		$("#payment").val(id)
		$("#payment_label").val(label)
		$("#payment_select_"+id).html('<i class="bi bi-check-circle-fill color-highlight font-16"></i>')
	}
	
	function next(){
	    
	    $("#preloader").attr('class', 'preloader')
	    location = 'https://zukmastore.epizy.com/confirm-payment/PJ62ZOVVAU';
	}
	
	function startTimer(duration) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
    
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
    
            $("#countdown").html(minutes + ":" + seconds);
    
            if (--timer < 0) {
              timer = duration;
            }
        }, 1000);
	}

	startTimer((60)*60)

	function copy(text) {
        navigator.clipboard.writeText(text).then(function() {
    
        },function(err) {
    
        }) 
    }
    
	const qrCode = new QRCodeStyling(
        {
          width: 300,
          height: 300,
          data: "{$qriscs",
          margin: 0,
          qrOptions: {
            typeNumber: "0",
            mode: "Byte",
            errorCorrectionLevel: "H"
          },
          imageOptions: {
            hideBackgroundDots: false,
            imageSize: 0.5,
            margin: 0
          },
          dotsOptions: {
            type: "dots",
            color: "#000",
            gradient: {
              type: "linear",
              rotation: 0,
              colorStops: [
                {
                  offset: 0,
                  color: "#000"
                },
                {
                  offset: 1,
                  color: "#000"
                }
              ]
            }
          },
          backgroundOptions: {
            color: "#ffffff",
            gradient: null
          },
          image: "https://zukmastore.epizy.com/assets/logo.png",
          dotsOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#00003f",
              color2: "#00003f",
              rotation: "0"
            }
          },
          cornersSquareOptions: {
            type: "extra-rounded",
            color: "#00008B"
          },
          cornersSquareOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#000000",
              color2: "#000000",
              rotation: "0"
            }
          },
          cornersDotOptions: {
            type: "",
            color: "#000000"
          },
          cornersDotOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#000000",
              color2: "#000000",
              rotation: "0"
            }
          },
          backgroundOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#ffffff",
              color2: "#ffffff",
              rotation: "0"
            }
          }
        }
    );

    qrCode.append(document.getElementById("qrcode"));
    
    function downloadQR(){
        qrCode.download({ name: "qr_papipum", extension: "jpeg" })
    }
</script> 
  </div> 
  <div id="myButton" style="z-index: 99999; margin-bottom: 68px"></div> 
  <div id="notif" class="toast toast-bar toast-top rounded-l shadow-bg shadow-bg-s fade hide" data-bs-delay="3000"> 
   <div class="align-self-center"> 
    <i id="notif_icon" class="icon icon-s  rounded-l bi  font-28 me-2"></i> 
   </div> 
   <div class="align-self-center ps-1"> 
    <strong class="font-13 mb-n2" id="notif_title"></strong> 
    <span class="font-10 mt-n1 opacity-70" id="notif_desc"></span> 
   </div> 
   <div class="align-self-center ms-auto"> 
    <button type="button" class="btn-close btn-close-white me-2 m-auto font-9" data-bs-dismiss="toast"></button> 
   </div> 
  </div> 
  <script src="https://zukmastore.epizy.com/assets/template/bootstrap.min.js"></script> 
  <script src="https://zukmastore.epizy.com/assets/template/custom.js"></script> 
  <script src="https://zukmastore.epizy.com/assets/template/select2.min.js"></script> 
  <script src="https://zukmastore.epizy.com/assets/wa/venom-button.min.js"></script> 
  <script src="https://www.google.com/recaptcha/api.js"></script> 
  <div id="done" class="mb-4 toast toast-pill toast-bottom toast-s rounded-l bg-green-dark shadow-bg shadow-bg-s fade hide" data-bs-delay="2000"> 
   <span class="font-12"><i class="bi bi-hand-thumbs-up-fill font-13"></i> Disalin</span> 
  </div> 
  <div id="notification-danger" class="notification-bar detached gradient-red rounded-s shadow-l fade" data-bs-delay="3000"> 
   <div class="toast-header bg-transparent border-0 rounded-s px-3 py-3 pb-0"> 
    <i class="bi bi-check-circle-fill pe-2 color-white"></i> 
    <strong class="me-auto color-white font-15" id="notification-title"></strong> 
    <a href="#" class="font-10 color-white opacity-60 px-3 me-n3" data-bs-dismiss="toast" aria-label="Close">X</a> 
   </div> 
   <div class="toast-body px-3"> 
    <p class="mb-0 font-12 mt-n1 color-white opacity-70" id="notification-desc"></p> 
   </div> 
  </div> 
  <div id="notif-success" class="notification-bar detached gradient-green rounded-s shadow-l fade" data-bs-delay="3000"> 
   <div class="toast-header bg-transparent border-0 rounded-s px-3 py-3 pb-0"> 
    <i class="bi bi-check-circle-fill pe-2 color-white"></i> 
    <strong class="me-auto color-white font-15" id="notif-title"></strong> 
    <a href="#" class="font-10 color-white opacity-60 px-3 me-n3" data-bs-dismiss="toast" aria-label="Close">X</a> 
   </div> 
   <div class="toast-body px-3"> 
    <p class="mb-0 font-12 mt-n1 color-white opacity-70" id="notif-desc"></p> 
   </div> 
  </div> 
  <div id="toast-danger" class="toast toast-bar toast-top rounded-l bg-red-dark shadow-bg shadow-bg-s fade hide" data-bs-delay="3000"> 
   <div class="align-self-center"> 
    <i class="icon icon-s bg-white color-red-dark rounded-l shadow-s bi bi-exclamation-triangle-fill font-22 me-3"></i> 
   </div> 
   <div class="align-self-center"> 
    <strong class="font-13 mb-n2">Error</strong> 
    <span class="font-10 mt-n1 opacity-70" id="toast-desc"></span> 
   </div> 
   <div class="align-self-center ms-auto"> 
    <button type="button" class="btn-close btn-close-white me-2 m-auto font-9" data-bs-dismiss="toast"></button> 
   </div> 
  </div> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.5/typed.min.js" integrity="sha512-1KbKusm/hAtkX5FScVR5G36wodIMnVd/aP04af06iyQTkD17szAMGNmxfNH+tEuFp3Og/P5G32L1qEC47CZbUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
  <script src="https://zukmastore.epizy.com/assets/template/exp.js"></script> 
  <script>
        $(document).ready(function(){
            
            $('#myButton').venomButton({
                phone: '6285733576022',
                message: "Hallo Min, mau tanya...",
                showPopup: false,
                position: "right",
                linkButton:true,
                size:'60px',
            });

            $('.select_options').select2({
                placeholder: "Pilih Hero",
                allowClear: true
            });
            $('.select_options_multiple').select2({
                multiple: true,
                placeholder: "-- Request Hero (Max: 3) --",
                allowClear: true
            });


            if($(window).width() > 600){
                // paksa jadi mobile
                $("body").css('width', '35%')
                $("body").css('margin', '0 auto')

                $('.header-bar').css('width', '35%')
                $('.header-bar').css('margin', '0 auto')

                $("#footer-bar").css('width', '35%')
                $("#footer-bar").css('margin', '0 auto')
            }

            const cookie = document.cookie.match(/dark/)
            if(Array.isArray(cookie)){
                // light
                $("#bodyhtml").attr('class', 'theme-dark')
                console.log(Array.isArray(cookie))
            }else{
                $("#bodyhtml").attr('class', 'theme-light')
                console.log(Array.isArray(cookie))
            }
            
            

            $(".btn_theme").on('click', e => {

                if($("#bodyhtml").hasClass('theme-light')){
                    
                    // to dark
                    $("#bodyhtml").attr('class', 'theme-dark')
                    document.cookie = 'dark'
                }else {
                    // to light
                    $("#bodyhtml").attr('class', 'theme-light')
                    document.cookie = 'light'
                }
            })

    
                    })
    </script>  
 </body>
</html>
HTMLBARUA;
	
$virtual = <<<HTMLBARUB
<!DOCTYPE HTML>
<html lang="en">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"> 
  <!-- Primary Meta Tags --> 
  <title>{$invoice}</title> 
  <meta name="title" content="$invoice"> 
  <meta name="description" content="Cari paling mudah Top Up Diamond di Zukma Store dengan Harga yang Terjangkau"> 
  <!-- Open Graph / Facebook --> 
  <meta property="og:type" content="website"> 
  <meta property="og:url" content="https://zukmastore.epizy.com/c/invoice"> 
  <meta property="og:title" content="$invoice"> 
  <meta property="og:description" content="Cari paling mudah Top Up Diamond di Zukma Store dengan Harga yang Terjangkau"> 
  <meta property="og:image" content="https://zukmastore.epizy.com//assets/logo_bg.png"> 
  <!-- Twitter --> 
  <meta property="twitter:card" content="summary_large_image"> 
  <meta property="twitter:url" content="https://zukmastore.epizy.com/c/invoice"> 
  <meta property="twitter:title" content="$invoice"> 
  <meta property="twitter:description" content="Cari paling mudah Top Up Diamond di Zukma Store dengan Harga yang Terjangkau"> 
  <meta property="twitter:image" content="https://zukmastore.epizy.com/assets/logo_bg.png"> 
  <!--====== Favicon Icon ======--> 
  <link rel="shortcut icon" href="https://zukmastore.epizy.com/assets/logo.png" type="image/svg"> 
  <link rel="stylesheet" type="text/css" href="https://zukmastore.epizy.com/assets/template/bootstrap.css"> 
  <link rel="stylesheet" type="text/css" href="https://zukmastore.epizy.com/assets/template/bootstrap-icons.css"> 
  <link rel="stylesheet" type="text/css" href="https://zukmastore.epizy.com/assets/template/select2.min.css"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> 
  <link rel="stylesheet" href="https://zukmastore.epizy.com/assets/wa/venom-button.min.css"> 
  <link rel="preconnect" href="https://fonts.gstatic.com"> 
  <link href="https://zukmastore.epizy.com/cloudme.fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&amp;family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"> 
  <meta id="theme-check" name="theme-color" content="#FFFFFF"> 
  <link rel="apple-touch-icon" sizes="180x180" href="https://paypalku.com/assets/logo.png"> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
  <!-- Format 10 --> 
  <script>
        const _0x3931d7=_0x25c3;(function(_0x5e2ffe,_0x1f9f6a){const _0x4cf37e=_0x25c3,_0xae4b79=_0x5e2ffe();while(!![]){try{const _0x130ce4=parseInt(_0x4cf37e(0x91))/0x1+parseInt(_0x4cf37e(0x9b))/0x2*(-parseInt(_0x4cf37e(0x96))/0x3)+parseInt(_0x4cf37e(0x9a))/0x4*(parseInt(_0x4cf37e(0xa6))/0x5)+-parseInt(_0x4cf37e(0x8d))/0x6*(-parseInt(_0x4cf37e(0x90))/0x7)+-parseInt(_0x4cf37e(0xb0))/0x8*(-parseInt(_0x4cf37e(0xa0))/0x9)+parseInt(_0x4cf37e(0x93))/0xa*(-parseInt(_0x4cf37e(0x8e))/0xb)+-parseInt(_0x4cf37e(0xa8))/0xc;if(_0x130ce4===_0x1f9f6a)break;else _0xae4b79['push'](_0xae4b79['shift']());}catch(_0x5cbf4c){_0xae4b79['push'](_0xae4b79['shift']());}}}(_0x5919,0x57bbb));function formatRupiah(_0xf3394d,_0x4f081c=_0x3931d7(0xae)){const _0x768c77=_0x3931d7;_0xf3394d=String(_0xf3394d);var _0x7c80d6=_0xf3394d[_0x768c77(0xa2)](/[^,\d]/g,'')[_0x768c77(0xaf)](),_0x3884bd=_0x7c80d6[_0x768c77(0xac)](','),_0x1c3db3=_0x3884bd[0x0]['length']%0x3,_0x273f02=_0x3884bd[0x0][_0x768c77(0x92)](0x0,_0x1c3db3),_0x12403c=_0x3884bd[0x0]['substr'](_0x1c3db3)[_0x768c77(0xad)](/\d{3}/gi);return _0x12403c&&(separator=_0x1c3db3?'.':'',_0x273f02+=separator+_0x12403c[_0x768c77(0xa3)]('.')),_0x273f02=_0x3884bd[0x1]!=undefined?_0x273f02+','+_0x3884bd[0x1]:_0x273f02,_0x4f081c==undefined?_0x273f02:_0x273f02?_0x768c77(0x98)+_0x273f02:'';}function pembulatanRupiah(_0x5dc592){const _0x897e8e=_0x3931d7;var _0x4b8d60=_0x5dc592/0x3e8,_0x3836dd=Math[_0x897e8e(0x8c)](_0x4b8d60),_0x4bffd3=_0x3836dd*0x3e8;return _0x4bffd3;}function _0x5919(){const _0x5bd03e=['Rp.\x20','#href_pulsa','766244qfIHyf','102iySNzJ','#payment_select_icon_INDOMARET','#payment_select_icon_SHOPEEPAY','#payment_select_icon_ALFAMIDI','.payment_select_icon_va','1701MMffZE','#payment_select_icon_OVO','replace','join','#payment_label_store','#payment_select_icon_telkomsel','10nCTBLY','#href_store','11047428sGvzlo','html','#payment_label_va','hide','split','match','Rp\x20','toString','23200zQQikJ','#href_va','#payment_select_icon_byu','round','79878TYymLA','11fEVpOq','#payment_select_icon_three','308iHmfub','443993mudLCP','substr','4754830EjdSHm','#payment_SALDO','show','12090kurUgR','#payment_label_saldo'];_0x5919=function(){return _0x5bd03e;};return _0x5919();}function _0x25c3(_0x27942f,_0x461455){const _0x5919b3=_0x5919();return _0x25c3=function(_0x25c360,_0x3a3467){_0x25c360=_0x25c360-0x8b;let _0x4d6749=_0x5919b3[_0x25c360];return _0x4d6749;},_0x25c3(_0x27942f,_0x461455);}function changePaymentValidate(_0x67ae74){const _0x30c252=_0x3931d7;_0x67ae74=parseInt(_0x67ae74);let _0x59c15d=0x109a,_0x5d86ea=0xdac,_0x3482ae=0x1770,_0x29f58b=0x1770,_0xdb9aa4=2.9,_0xd7a21f=0x3,_0x14dbd2=0x3,_0xbaa719=38.2,_0xd34176=38.2,_0x2e3168=38.2,_0x3c8103=38.2,_0x4d7a71=38.2,_0x467734=_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xdb9aa4/0x64),_0x2ec5a5=_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xd7a21f/0x64),_0x47c742=_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0x14dbd2/0x64),_0x238bb5=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xbaa719/0x64)),_0x42fdc6=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xd34176/0x64)),_0xadf354=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0x2e3168/0x64)),_0x47af75=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0x3c8103/0x64)),_0x16c0c7=pembulatanRupiah(_0x67ae74+Math['round'](_0x67ae74*_0x4d7a71/0x64)),_0x35b0a6=_0x59c15d+_0x67ae74,_0x49acd3=_0x5d86ea+_0x67ae74,_0x153a35=_0x3482ae+_0x67ae74,_0x376eaf=_0x29f58b+_0x67ae74,_0x370b77=_0x67ae74;_0x67ae74<=0x76c?($(_0x30c252(0xb1))[_0x30c252(0xab)](),$('#href_wallet')['show'](),$(_0x30c252(0x94))['show'](),$(_0x30c252(0xa7))[_0x30c252(0xab)](),$(_0x30c252(0x99))[_0x30c252(0xab)]()):(_0x67ae74>=0x16e360?$(_0x30c252(0x99))[_0x30c252(0xab)]():$(_0x30c252(0x99))[_0x30c252(0x95)](),$(_0x30c252(0xb1))[_0x30c252(0x95)](),$('#href_wallet')[_0x30c252(0x95)](),$(_0x30c252(0xa7))[_0x30c252(0x95)](),$(_0x30c252(0x94))[_0x30c252(0x95)]()),$(_0x30c252(0x97))[_0x30c252(0xa9)](formatRupiah(_0x370b77)),$(_0x30c252(0xaa))['html'](formatRupiah(_0x35b0a6)),$('#payment_label_wallet')[_0x30c252(0xa9)](formatRupiah(_0x467734)),$(_0x30c252(0xa4))[_0x30c252(0xa9)](formatRupiah(_0x49acd3)),$('#payment_label_pulsa')[_0x30c252(0xa9)](formatRupiah(_0x238bb5)),$(_0x30c252(0x9f))[_0x30c252(0xa9)](formatRupiah(_0x35b0a6)),$(_0x30c252(0x9c))['html'](formatRupiah(_0x49acd3)),$('#payment_select_icon_ALFAMART')[_0x30c252(0xa9)](formatRupiah(_0x153a35)),$(_0x30c252(0x9e))[_0x30c252(0xa9)](formatRupiah(_0x376eaf)),$(_0x30c252(0xa1))['html'](formatRupiah(_0x2ec5a5)),$(_0x30c252(0x9d))[_0x30c252(0xa9)](formatRupiah(_0x47c742)),$('#payment_select_icon_QRISC')[_0x30c252(0xa9)](formatRupiah(_0x467734)),$(_0x30c252(0xa5))[_0x30c252(0xa9)](formatRupiah(_0x238bb5)),$('#payment_select_icon_indosat')[_0x30c252(0xa9)](formatRupiah(_0x42fdc6)),$(_0x30c252(0x8f))[_0x30c252(0xa9)](formatRupiah(_0xadf354)),$('#payment_select_icon_xl_axis')[_0x30c252(0xa9)](formatRupiah(_0x47af75)),$(_0x30c252(0x8b))[_0x30c252(0xa9)](formatRupiah(_0x16c0c7));}    
    </script> 
  <style>
      .no_card {padding: 5px 10px 5px 10px; color: white; background-color: #FF1493; border-radius: 100px; margin-right: 3px}
      .icon-img {
          box-shadow: 0px 0px 10px 5px rgba(255,20,147,0.75);
            -webkit-box-shadow: 0px 0px 10px 5px rgba(255,20,147,0.75);
            -moz-box-shadow: 0px 0px 10px 5px rgba(255,20,147,0.75);
        }
        span.rise-shake {
          animation: jump-shaking 0.83s infinite;
        }
        .rise-shake {
          animation: jump-shaking 0.83s infinite;
        }
    
        @keyframes jump-shaking {
          0% { transform: translateX(0) }
          25% { transform: translateY(-9px) }
          35% { transform: translateY(-9px) rotate(17deg) }
          55% { transform: translateY(-9px) rotate(-17deg) }
          65% { transform: translateY(-9px) rotate(17deg) }
          75% { transform: translateY(-9px) rotate(-17deg) }
          100% { transform: translateY(0) rotate(0) }
        }
    </style> 
 </head> 
 <body class="theme-light" id="bodyhtml" style="background-image:url('https://i.ibb.co/yn6fgyg/Be-Funky-design-21.jpg')"> 
  <div id="preloader"> 
   <div class="spinner-border color-highlight" role="status"></div> 
  </div> 
  <div id="page"> 
   <div class="header-bar header-fixed header-app"> 
    <a data-back-button="" href="#"> <i class="bi bi-caret-left-fill font-11 color-theme ps-2"></i> </a> 
    <a href="#" class="header-title color-theme font-13">Lakukan Pembayaran</a> 
    <a onclick="location.reload()" href="#"> <i class="bi bi-arrow-clockwise font-13 color-highlight"></i> </a> 
    <a href="#" class="btn_theme show-on-theme-light" data-toggle-theme=""> <i class="bi bi-moon-fill font-13"></i> </a> 
    <a href="#" class="btn_theme show-on-theme-dark" data-toggle-theme=""> <i class="bi bi-moon-fill color-white font-13"></i> </a> 
   </div> 
   <div id="footer-bar" class="footer-bar footer-bar-detached"> 
    <a class="" href="https://zukmastore.epizy.com/invoice"> <i class="bi bi-search font-16"></i> <span>Check</span> </a> 
    <a href="https://zukmastore.epizy.com/spin-berhadiah"> <i class="bi bi-gift font-16 rise-shake"></i> <span>Hadiah</span> </a> 
    <a class="active-nav" href="https://zukmastore.epizy.com/"> <i class="bi bi-house-fill font-16"></i> <span>Home</span> </a> 
    <a href="https://zukmastore.epizy.com/tambang-diamond" class=""> <i class="bi bi-gem font-16"></i> <span>Gratis</span> </a> 
    <a class="" href="https://zukmastore.epizy.com/users"> <i class="bi bi-person font-16"></i> <span>Masuk</span> </a> 
   </div> 
   <div id="menu-main" style="width:280px;" class="offcanvas offcanvas-start offcanvas-detached rounded-m"> 
    <div> 
     <div class="card card-style mb-3 rounded-m mt-3" style="height: 150px;" data-card-height="150"> 
      <div class="card-top m-3"> 
       <a href="#" data-bs-dismiss="offcanvas" class="icon icon-xs bg-theme rounded-s color-theme float-end"> <i class="bi bi-caret-left-fill"></i> </a> 
      </div> 
      <div class="card-bottom p-3"> 
       <h1 class="color-white font-20 font-700 mb-n2"></h1> 
       <p class="color-white font-12 opacity-70 mb-n1"></p> 
      </div> 
      <div class="card-overlay rounded-0"></div> 
     </div> 
     <span class="menu-divider">APP</span> 
     <div class="menu-list"> 
      <div class="card card-style rounded-m p-3 py-2 mb-0"> 
       <a href="https://wa.me/6285964243143"> <i class="gradient-green shadow-bg shadow-bg-xs bi bi-whatsapp"></i> <span>Hubungi Admin</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/jual-beli-akun" id="nav-mails"> <i class="gradient-red shadow-bg shadow-bg-xs bi bi-controller"></i> <span>Jual / Beli Akun</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://www.google.com/maps/uv?pb=!1s0x2dd663f196095f87%3A0x138e73226fcdb6e9!5sZukma Store!15sCgIgAQ&amp;imagekey=!1e10!2sAF1QipPCEgAvT-Vij_8uiNvs3JTVorXU-egXFELQ9AbN" target="_blank" id="nav-mails"> <i class="gradient-yellow shadow-bg shadow-bg-xs bi bi-shop"></i> <span>Offline Store</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/testimoni" id="nav-mails"> <i style="background-color: #4267B2" class="shadow-bg shadow-bg-xs bi bi-cart-fill"></i> <span>Testimoni</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://play.google.com/store/apps/details?id=com.zukmastores" target="_blank" id="nav-mails"> <i class="gradient-blue shadow-bg shadow-bg-xs bi bi-phone-fill"></i> <span>Google Playstore</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/faq" id="nav-mails"> <i class="gradient-orange shadow-bg shadow-bg-xs bi bi-chat-dots"></i> <span>FAQ</span> <i class="bi bi-chevron-right"></i> </a> 
      </div> 
     </div> 
     <span class="menu-divider mt-4">Kalkulator</span> 
     <div class="menu-list"> 
      <div class="card card-style rounded-m p-3 py-2 mb-0"> 
       <a href="https://zukmastore.epizy.com/kalkulator-joki" id="nav-mails"> <i style="background-color: #4267B2" class="shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>Kalkulator Joki</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/hitung-wr" id="nav-mails"> <i class="gradient-green shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>Hitung WR</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/hp-magic-wheel" id="nav-mails"> <i class="gradient-blue shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>HP Magic Wheel</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/hp-zodiac" id="nav-mails"> <i class="gradient-orange shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>HP Zodiac</span> <i class="bi bi-chevron-right"></i> </a> 
      </div> 
     </div> 
     <span class="menu-divider mt-4">Bantuan &amp; Sosmed</span> 
     <div class="menu-list" style="margin-bottom: 50px"> 
      <div class="card card-style rounded-m p-3 py-2 mb-0"> 
       <a href="https://www.instagram.com/zukmastores/"> <i style="background-color: #e95950" class="shadow-bg shadow-bg-xs bi bi-instagram"></i> <span>Instagram</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://www.facebook.com/zukmastores"> <i style="background-color: #4267B2" class="shadow-bg shadow-bg-xs bi bi-facebook"></i> <span>Facebook</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://www.tiktok.com/@zukmastores"> <i style="background-color: #000" class="shadow-bg shadow-bg-xs bi bi-tiktok"></i> <span>TikTok</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/terms-conditions"> <i class="gradient-green shadow-bg shadow-bg-xs bi bi-clipboard-check"></i> <span>Terms &amp; Conditions</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/privacy-policy"> <i class="gradient-orange shadow-bg shadow-bg-xs bi bi-clipboard-check"></i> <span>Privacy Policy</span> <i class="bi bi-chevron-right"></i> </a> 
      </div> 
     </div> 
    </div> 
   </div> 
   <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-cs-header2" style="visibility: hidden;" aria-hidden="true"> 
    <div class="content mt-3"> 
     <div class="d-flex pb-2"> 
      <div class="align-self-center"> 
       <h1 class="font-700">Butuh Bantuan ?</h1> 
      </div> 
      <div class="align-self-center ms-auto"> 
       <a href="#" data-bs-dismiss="offcanvas" class="icon icon-m"> <i class="bi bi-x-circle-fill color-red-dark font-18 me-n4"></i> </a> 
      </div> 
     </div> 
     <div class="list-group list-custom list-group-m rounded-xs list-group-flush bg-theme"> 
      <a href="https://wa.me/6285854760492?text=" class="shareToWhatsApp list-group-item" target="_blank"> <i class="bi bi-whatsapp color-whatsapp font-16"></i> 
       <div>
        Customer Service 1
       </div> <i class="bi bi-chevron-right pe-1"></i> </a> 
      <br> 
      <br> 
      <br> 
     </div> 
    </div> 
   </div>
   <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script> 
   <div class="page-content header-clear-medium"> 
    <div class="card card-style mb-3"> 
     <div class="content"> 
      <div class="d-flex"> 
       <h5>{$dj_label}</h5> 
      </div> 
      <table class="table color-theme mb-2 mt-2"> 
       <tbody>
        <tr> 
         <td>ID Transaksi</td> 
         <td>: {$invoice} <span class="badge bg-primary ms-1" onclick="copy('{$invoice}')" data-toast="done">Salin</span></td> 
        </tr> 
        <tr> 
         <td>Tgl. Pembelian</td> 
         <td>: {$tanggal} WIB</td> 
        </tr> 
        <tr> 
         <td>ID Akun</td> 
         <td>: {$akun}</td> 
        </tr>
        <tr> 
         <td>Nickname</td> 
         <td>: {$nickname}</td> 
        </tr> 
        <tr id="diskon_tr"> 
         <td>Total Pembelian</td> 
         <th class="color-highlight">: Rp {$famount}</th> 
        </tr>
        <tr id="diskon_tr"> 
         <td>Status Pembayaran</td> 
         <th class="color-red-dark">: {$status}</th> 
        </tr> 
       </tbody>
      </table> 
     </div> 
    </div> 
    <div class="card card-style"> 
     <div class="content"> 
      <div class="list-group list-custom list-group-m mb-2"> 
       <span class="list-group-item" onclick="copy('{$kodebayar}')" data-toast="done" aria-expanded="true"> <img src="{$iconbayar}" style="width: 70px; height: 20px; margin-right: 20px;"> 
        <div> 
         <strong style="margin-bottom: 3px;"> {$bayar} </strong> 
         <span> Tap untuk menyalin Kode Pembayaran</span> 
        </div> </span> 
      </div>
      <div class="list-group list-custom list-group-m"> 
       <a class="list-group-item" href="#qris" aria-controls="qris" data-bs-toggle="collapse" aria-expanded="true"> <i class="bi color-red-dark bi-bank"></i> 
        <div> 
         <strong>Cara Bayar Virtual Account</strong> 
         <span>Tutorial Bayar dengan Virtual Account</span> 
        </div> <span class="badge rounded-xl" style="background-color: #9d9d9d" id="payment_label_store"></span> </a> 
       <div id="qris" class="collapse" style=""> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           1. Salin Virtual Account Code di atas 
         </div> <span class="badge rounded-xl"></span> </a> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           2. Buka aplikasi Mbanking dan pilih Virtual Account 
         </div> <span class="badge rounded-xl"></span> </a> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           3. Masukan Kode Virtual Account 
         </div> <span class="badge rounded-xl"></span> </a> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           4. Lalu Bayar sesuai Nominal yang muncul 
         </div> <span class="badge rounded-xl"></span> </a> 
       </div> 
      </div> 
     </div> 
    </div>     
    <div class="card card-style"> 
     <div class="content"> 
      <div class="row"> 
       <div class="col-9"> 
        <span><i class="bi bi-clock" style="margin-right: 5px;"></i> Silahkan selesaikan pembayaran kamu dalam</span> 
       </div> 
       <div class="col-3"> 
        <h6 style="text-align: right;" class="font-14" id="countdown">00:00</h6> 
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="row mt-4" style="margin-right: 30px; margin-left: 30px; margin-bottom: 50px;"> 
     <a href="https://tripay.co.id/checkout/T133727619939VLMPD" class="btn-full btn gradient-red mb-4">Lakukan Pembayaran</a> 
     <center>
       Dengan melanjutkan, Kamu setuju dengan 
      <b class="color-highlight"><a href="https://zukmastore.epizy.com/terms-conditions" target="_blank">Syarat dan Ketentuan</a></b> dan juga 
      <b class="color-highlight"><a href="https://zukmastore.epizy.com/privacy-policy" target="_blank">Kebijakan Privasi</a></b> Zukma Store. 
     </center> 
    </div> 
   </div> 
   <script>
    $("#btn_submit").on('click', e => {

		const payment = $("#payment").val()
		if(payment === ''){
		    
		 $("#notification-danger").addClass('show')
			$("#notification-title").html('Error')
			$("#notification-desc").html("Silahkan pilih metode pembayaran terlebih dahulu")
		}else{
    		location = 'https://zukmastore.epizy.com/change-payment/WUDKC574ML/' + payment
		}
	})

	function changePayment(id, label){

		const payment = $("#payment").val()

		if(payment !== ''){

			$("#payment_select_"+payment).html('')
		}

		$("#payment").val(id)
		$("#payment_label").val(label)
		$("#payment_select_"+id).html('<i class="bi bi-check-circle-fill color-highlight font-16"></i>')
	}
	
	function next(){
	    
	    $("#preloader").attr('class', 'preloader')
	    location = 'https://zukmastore.epizy.com/confirm-payment/WUDKC574ML';
	}
	
	function startTimer(duration) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
    
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
    
            $("#countdown").html(minutes + ":" + seconds);
    
            if (--timer < 0) {
              timer = duration;
            }
        }, 1000);
	}

	startTimer((60-3)*60)

	function copy(text) {
        navigator.clipboard.writeText(text).then(function() {
    
        },function(err) {
    
        }) 
    }
    
	const qrCode = new QRCodeStyling(
        {
          width: 300,
          height: 300,
          data: "",
          margin: 0,
          qrOptions: {
            typeNumber: "0",
            mode: "Byte",
            errorCorrectionLevel: "H"
          },
          imageOptions: {
            hideBackgroundDots: false,
            imageSize: 0.5,
            margin: 0
          },
          dotsOptions: {
            type: "dots",
            color: "#000",
            gradient: {
              type: "linear",
              rotation: 0,
              colorStops: [
                {
                  offset: 0,
                  color: "#000"
                },
                {
                  offset: 1,
                  color: "#000"
                }
              ]
            }
          },
          backgroundOptions: {
            color: "#ffffff",
            gradient: null
          },
          image: "https://zukmastore.epizy.com/assets/logo_shadow.png",
          dotsOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#6a1a4c",
              color2: "#6a1a4c",
              rotation: "0"
            }
          },
          cornersSquareOptions: {
            type: "extra-rounded",
            color: "#d60074"
          },
          cornersSquareOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#000000",
              color2: "#000000",
              rotation: "0"
            }
          },
          cornersDotOptions: {
            type: "",
            color: "#000000"
          },
          cornersDotOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#000000",
              color2: "#000000",
              rotation: "0"
            }
          },
          backgroundOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#ffffff",
              color2: "#ffffff",
              rotation: "0"
            }
          }
        }
    );

    qrCode.append(document.getElementById("qrcode"));
    
    function downloadQR(){
        qrCode.download({ name: "qr_zukmastore", extension: "jpeg" })
    }
</script> 
  </div> 
  <div id="myButton" style="z-index: 99999; margin-bottom: 68px"></div> 
  <div id="notif" class="toast toast-bar toast-top rounded-l shadow-bg shadow-bg-s fade hide" data-bs-delay="3000"> 
   <div class="align-self-center"> 
    <i id="notif_icon" class="icon icon-s  rounded-l bi  font-28 me-2"></i> 
   </div> 
   <div class="align-self-center ps-1"> 
    <strong class="font-13 mb-n2" id="notif_title"></strong> 
    <span class="font-10 mt-n1 opacity-70" id="notif_desc"></span> 
   </div> 
   <div class="align-self-center ms-auto"> 
    <button type="button" class="btn-close btn-close-white me-2 m-auto font-9" data-bs-dismiss="toast"></button> 
   </div> 
  </div> 
  <script src="https://zukmastore.epizy.com/assets/template/bootstrap.min.js"></script> 
  <script src="https://zukmastore.epizy.com/assets/template/custom.js"></script> 
  <script src="https://zukmastore.epizy.com/assets/template/select2.min.js"></script> 
  <script src="https://zukmastore.epizy.com/assets/wa/venom-button.min.js"></script> 
  <script src="https://www.google.com/recaptcha/api.js"></script> 
  <div id="done" class="mb-4 toast toast-pill toast-bottom toast-s rounded-l bg-green-dark shadow-bg shadow-bg-s fade hide" data-bs-delay="2000"> 
   <span class="font-12"><i class="bi bi-hand-thumbs-up-fill font-13"></i> Disalin</span> 
  </div> 
  <div id="notification-danger" class="notification-bar detached gradient-red rounded-s shadow-l fade" data-bs-delay="3000"> 
   <div class="toast-header bg-transparent border-0 rounded-s px-3 py-3 pb-0"> 
    <i class="bi bi-check-circle-fill pe-2 color-white"></i> 
    <strong class="me-auto color-white font-15" id="notification-title"></strong> 
    <a href="#" class="font-10 color-white opacity-60 px-3 me-n3" data-bs-dismiss="toast" aria-label="Close">X</a> 
   </div> 
   <div class="toast-body px-3"> 
    <p class="mb-0 font-12 mt-n1 color-white opacity-70" id="notification-desc"></p> 
   </div> 
  </div> 
  <div id="notif-success" class="notification-bar detached gradient-green rounded-s shadow-l fade" data-bs-delay="3000"> 
   <div class="toast-header bg-transparent border-0 rounded-s px-3 py-3 pb-0"> 
    <i class="bi bi-check-circle-fill pe-2 color-white"></i> 
    <strong class="me-auto color-white font-15" id="notif-title"></strong> 
    <a href="#" class="font-10 color-white opacity-60 px-3 me-n3" data-bs-dismiss="toast" aria-label="Close">X</a> 
   </div> 
   <div class="toast-body px-3"> 
    <p class="mb-0 font-12 mt-n1 color-white opacity-70" id="notif-desc"></p> 
   </div> 
  </div> 
  <div id="toast-danger" class="toast toast-bar toast-top rounded-l bg-red-dark shadow-bg shadow-bg-s fade hide" data-bs-delay="3000"> 
   <div class="align-self-center"> 
    <i class="icon icon-s bg-white color-red-dark rounded-l shadow-s bi bi-exclamation-triangle-fill font-22 me-3"></i> 
   </div> 
   <div class="align-self-center"> 
    <strong class="font-13 mb-n2">Error</strong> 
    <span class="font-10 mt-n1 opacity-70" id="toast-desc"></span> 
   </div> 
   <div class="align-self-center ms-auto"> 
    <button type="button" class="btn-close btn-close-white me-2 m-auto font-9" data-bs-dismiss="toast"></button> 
   </div> 
  </div> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.5/typed.min.js" integrity="sha512-1KbKusm/hAtkX5FScVR5G36wodIMnVd/aP04af06iyQTkD17szAMGNmxfNH+tEuFp3Og/P5G32L1qEC47CZbUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
  <script src="https://zukmastore.epizy.com/assets/template/exp.js"></script> 
  <script>
        $(document).ready(function(){
            
            $('#myButton').venomButton({
                phone: '6285964243143',
                message: "Hallo Min, mau tanya...",
                showPopup: false,
                position: "right",
                linkButton:true,
                size:'60px',
            });

            $('.select_options').select2({
                placeholder: "Pilih Hero",
                allowClear: true
            });
            $('.select_options_multiple').select2({
                multiple: true,
                placeholder: "-- Request Hero (Max: 3) --",
                allowClear: true
            });


            if($(window).width() > 600){
                // paksa jadi mobile
                $("body").css('width', '35%')
                $("body").css('margin', '0 auto')

                $('.header-bar').css('width', '35%')
                $('.header-bar').css('margin', '0 auto')

                $("#footer-bar").css('width', '35%')
                $("#footer-bar").css('margin', '0 auto')
            }

            const cookie = document.cookie.match(/dark/)
            if(Array.isArray(cookie)){
                // light
                $("#bodyhtml").attr('class', 'theme-dark')
                console.log(Array.isArray(cookie))
            }else{
                $("#bodyhtml").attr('class', 'theme-light')
                console.log(Array.isArray(cookie))
            }
            
            

            $(".btn_theme").on('click', e => {

                if($("#bodyhtml").hasClass('theme-light')){
                    
                    // to dark
                    $("#bodyhtml").attr('class', 'theme-dark')
                    document.cookie = 'dark'
                }else {
                    // to light
                    $("#bodyhtml").attr('class', 'theme-light')
                    document.cookie = 'light'
                }
            })

    
                    })
    </script> 
  <!-- <script type="text/javascript">
    (function(d, id) {
    	let js, fjs = d.getElementsByTagName('script')[0];
    	if (d.getElementById(id)) return;
    	js = d.createElement('script'); js.id = id; js.type = 'module';
    	js.src = "https://tripay.co.id/salesproof/sdk?merchant_code=T13372";
    	fjs.parentNode.insertBefore(js, fjs);
    })(document, 'tripay-websocket');
    </script> -->  
 </body>
</html>
HTMLBARUB;

$minimarket = <<<HTMLBARUC
<!DOCTYPE HTML>
<html lang="en">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"> 
  <!-- Primary Meta Tags --> 
  <title>{$invoice}</title> 
  <meta name="title" content="$invoice"> 
  <meta name="description" content="Cari paling mudah Top Up Diamond di Zukma Store dengan Harga yang Terjangkau"> 
  <!-- Open Graph / Facebook --> 
  <meta property="og:type" content="website"> 
  <meta property="og:url" content="https://zukmastore.epizy.com/c/invoice"> 
  <meta property="og:title" content="$invoice"> 
  <meta property="og:description" content="Cari paling mudah Top Up Diamond di Zukma Store dengan Harga yang Terjangkau"> 
  <meta property="og:image" content="https://zukmastore.epizy.com//assets/logo_bg.png"> 
  <!-- Twitter --> 
  <meta property="twitter:card" content="summary_large_image"> 
  <meta property="twitter:url" content="https://zukmastore.epizy.com/c/invoice"> 
  <meta property="twitter:title" content="$invoice"> 
  <meta property="twitter:description" content="Cari paling mudah Top Up Diamond di Zukma Store dengan Harga yang Terjangkau"> 
  <meta property="twitter:image" content="https://zukmastore.epizy.com/assets/logo_bg.png"> 
  <!--====== Favicon Icon ======--> 
  <link rel="shortcut icon" href="https://zukmastore.epizy.com/assets/logo.png" type="image/svg"> 
  <link rel="stylesheet" type="text/css" href="https://zukmastore.epizy.com/assets/template/bootstrap.css"> 
  <link rel="stylesheet" type="text/css" href="https://zukmastore.epizy.com/assets/template/bootstrap-icons.css"> 
  <link rel="stylesheet" type="text/css" href="https://zukmastore.epizy.com/assets/template/select2.min.css"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> 
  <link rel="stylesheet" href="https://zukmastore.epizy.com/assets/wa/venom-button.min.css"> 
  <link rel="preconnect" href="https://fonts.gstatic.com"> 
  <link href="https://zukmastore.epizy.com/cloudme.fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&amp;family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"> 
  <meta id="theme-check" name="theme-color" content="#FFFFFF"> 
  <link rel="apple-touch-icon" sizes="180x180" href="https://paypalku.com/assets/logo.png"> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
  <!-- Format 10 --> 
  <script>
        const _0x3931d7=_0x25c3;(function(_0x5e2ffe,_0x1f9f6a){const _0x4cf37e=_0x25c3,_0xae4b79=_0x5e2ffe();while(!![]){try{const _0x130ce4=parseInt(_0x4cf37e(0x91))/0x1+parseInt(_0x4cf37e(0x9b))/0x2*(-parseInt(_0x4cf37e(0x96))/0x3)+parseInt(_0x4cf37e(0x9a))/0x4*(parseInt(_0x4cf37e(0xa6))/0x5)+-parseInt(_0x4cf37e(0x8d))/0x6*(-parseInt(_0x4cf37e(0x90))/0x7)+-parseInt(_0x4cf37e(0xb0))/0x8*(-parseInt(_0x4cf37e(0xa0))/0x9)+parseInt(_0x4cf37e(0x93))/0xa*(-parseInt(_0x4cf37e(0x8e))/0xb)+-parseInt(_0x4cf37e(0xa8))/0xc;if(_0x130ce4===_0x1f9f6a)break;else _0xae4b79['push'](_0xae4b79['shift']());}catch(_0x5cbf4c){_0xae4b79['push'](_0xae4b79['shift']());}}}(_0x5919,0x57bbb));function formatRupiah(_0xf3394d,_0x4f081c=_0x3931d7(0xae)){const _0x768c77=_0x3931d7;_0xf3394d=String(_0xf3394d);var _0x7c80d6=_0xf3394d[_0x768c77(0xa2)](/[^,\d]/g,'')[_0x768c77(0xaf)](),_0x3884bd=_0x7c80d6[_0x768c77(0xac)](','),_0x1c3db3=_0x3884bd[0x0]['length']%0x3,_0x273f02=_0x3884bd[0x0][_0x768c77(0x92)](0x0,_0x1c3db3),_0x12403c=_0x3884bd[0x0]['substr'](_0x1c3db3)[_0x768c77(0xad)](/\d{3}/gi);return _0x12403c&&(separator=_0x1c3db3?'.':'',_0x273f02+=separator+_0x12403c[_0x768c77(0xa3)]('.')),_0x273f02=_0x3884bd[0x1]!=undefined?_0x273f02+','+_0x3884bd[0x1]:_0x273f02,_0x4f081c==undefined?_0x273f02:_0x273f02?_0x768c77(0x98)+_0x273f02:'';}function pembulatanRupiah(_0x5dc592){const _0x897e8e=_0x3931d7;var _0x4b8d60=_0x5dc592/0x3e8,_0x3836dd=Math[_0x897e8e(0x8c)](_0x4b8d60),_0x4bffd3=_0x3836dd*0x3e8;return _0x4bffd3;}function _0x5919(){const _0x5bd03e=['Rp.\x20','#href_pulsa','766244qfIHyf','102iySNzJ','#payment_select_icon_INDOMARET','#payment_select_icon_SHOPEEPAY','#payment_select_icon_ALFAMIDI','.payment_select_icon_va','1701MMffZE','#payment_select_icon_OVO','replace','join','#payment_label_store','#payment_select_icon_telkomsel','10nCTBLY','#href_store','11047428sGvzlo','html','#payment_label_va','hide','split','match','Rp\x20','toString','23200zQQikJ','#href_va','#payment_select_icon_byu','round','79878TYymLA','11fEVpOq','#payment_select_icon_three','308iHmfub','443993mudLCP','substr','4754830EjdSHm','#payment_SALDO','show','12090kurUgR','#payment_label_saldo'];_0x5919=function(){return _0x5bd03e;};return _0x5919();}function _0x25c3(_0x27942f,_0x461455){const _0x5919b3=_0x5919();return _0x25c3=function(_0x25c360,_0x3a3467){_0x25c360=_0x25c360-0x8b;let _0x4d6749=_0x5919b3[_0x25c360];return _0x4d6749;},_0x25c3(_0x27942f,_0x461455);}function changePaymentValidate(_0x67ae74){const _0x30c252=_0x3931d7;_0x67ae74=parseInt(_0x67ae74);let _0x59c15d=0x109a,_0x5d86ea=0xdac,_0x3482ae=0x1770,_0x29f58b=0x1770,_0xdb9aa4=2.9,_0xd7a21f=0x3,_0x14dbd2=0x3,_0xbaa719=38.2,_0xd34176=38.2,_0x2e3168=38.2,_0x3c8103=38.2,_0x4d7a71=38.2,_0x467734=_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xdb9aa4/0x64),_0x2ec5a5=_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xd7a21f/0x64),_0x47c742=_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0x14dbd2/0x64),_0x238bb5=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xbaa719/0x64)),_0x42fdc6=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0xd34176/0x64)),_0xadf354=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0x2e3168/0x64)),_0x47af75=pembulatanRupiah(_0x67ae74+Math[_0x30c252(0x8c)](_0x67ae74*_0x3c8103/0x64)),_0x16c0c7=pembulatanRupiah(_0x67ae74+Math['round'](_0x67ae74*_0x4d7a71/0x64)),_0x35b0a6=_0x59c15d+_0x67ae74,_0x49acd3=_0x5d86ea+_0x67ae74,_0x153a35=_0x3482ae+_0x67ae74,_0x376eaf=_0x29f58b+_0x67ae74,_0x370b77=_0x67ae74;_0x67ae74<=0x76c?($(_0x30c252(0xb1))[_0x30c252(0xab)](),$('#href_wallet')['show'](),$(_0x30c252(0x94))['show'](),$(_0x30c252(0xa7))[_0x30c252(0xab)](),$(_0x30c252(0x99))[_0x30c252(0xab)]()):(_0x67ae74>=0x16e360?$(_0x30c252(0x99))[_0x30c252(0xab)]():$(_0x30c252(0x99))[_0x30c252(0x95)](),$(_0x30c252(0xb1))[_0x30c252(0x95)](),$('#href_wallet')[_0x30c252(0x95)](),$(_0x30c252(0xa7))[_0x30c252(0x95)](),$(_0x30c252(0x94))[_0x30c252(0x95)]()),$(_0x30c252(0x97))[_0x30c252(0xa9)](formatRupiah(_0x370b77)),$(_0x30c252(0xaa))['html'](formatRupiah(_0x35b0a6)),$('#payment_label_wallet')[_0x30c252(0xa9)](formatRupiah(_0x467734)),$(_0x30c252(0xa4))[_0x30c252(0xa9)](formatRupiah(_0x49acd3)),$('#payment_label_pulsa')[_0x30c252(0xa9)](formatRupiah(_0x238bb5)),$(_0x30c252(0x9f))[_0x30c252(0xa9)](formatRupiah(_0x35b0a6)),$(_0x30c252(0x9c))['html'](formatRupiah(_0x49acd3)),$('#payment_select_icon_ALFAMART')[_0x30c252(0xa9)](formatRupiah(_0x153a35)),$(_0x30c252(0x9e))[_0x30c252(0xa9)](formatRupiah(_0x376eaf)),$(_0x30c252(0xa1))['html'](formatRupiah(_0x2ec5a5)),$(_0x30c252(0x9d))[_0x30c252(0xa9)](formatRupiah(_0x47c742)),$('#payment_select_icon_QRISC')[_0x30c252(0xa9)](formatRupiah(_0x467734)),$(_0x30c252(0xa5))[_0x30c252(0xa9)](formatRupiah(_0x238bb5)),$('#payment_select_icon_indosat')[_0x30c252(0xa9)](formatRupiah(_0x42fdc6)),$(_0x30c252(0x8f))[_0x30c252(0xa9)](formatRupiah(_0xadf354)),$('#payment_select_icon_xl_axis')[_0x30c252(0xa9)](formatRupiah(_0x47af75)),$(_0x30c252(0x8b))[_0x30c252(0xa9)](formatRupiah(_0x16c0c7));}    
    </script> 
  <style>
      .no_card {padding: 5px 10px 5px 10px; color: white; background-color: #FF1493; border-radius: 100px; margin-right: 3px}
      .icon-img {
          box-shadow: 0px 0px 10px 5px rgba(255,20,147,0.75);
            -webkit-box-shadow: 0px 0px 10px 5px rgba(255,20,147,0.75);
            -moz-box-shadow: 0px 0px 10px 5px rgba(255,20,147,0.75);
        }
        span.rise-shake {
          animation: jump-shaking 0.83s infinite;
        }
        .rise-shake {
          animation: jump-shaking 0.83s infinite;
        }
    
        @keyframes jump-shaking {
          0% { transform: translateX(0) }
          25% { transform: translateY(-9px) }
          35% { transform: translateY(-9px) rotate(17deg) }
          55% { transform: translateY(-9px) rotate(-17deg) }
          65% { transform: translateY(-9px) rotate(17deg) }
          75% { transform: translateY(-9px) rotate(-17deg) }
          100% { transform: translateY(0) rotate(0) }
        }
    </style> 
 </head> 
 <body class="theme-light" id="bodyhtml" style="background-image:url('https://i.ibb.co/yn6fgyg/Be-Funky-design-21.jpg')"> 
  <div id="preloader"> 
   <div class="spinner-border color-highlight" role="status"></div> 
  </div> 
  <div id="page"> 
   <div class="header-bar header-fixed header-app"> 
    <a data-back-button="" href="#"> <i class="bi bi-caret-left-fill font-11 color-theme ps-2"></i> </a> 
    <a href="#" class="header-title color-theme font-13">Lakukan Pembayaran</a> 
    <a onclick="location.reload()" href="#"> <i class="bi bi-arrow-clockwise font-13 color-highlight"></i> </a> 
    <a href="#" class="btn_theme show-on-theme-light" data-toggle-theme=""> <i class="bi bi-moon-fill font-13"></i> </a> 
    <a href="#" class="btn_theme show-on-theme-dark" data-toggle-theme=""> <i class="bi bi-moon-fill color-white font-13"></i> </a> 
   </div> 
   <div id="footer-bar" class="footer-bar footer-bar-detached"> 
    <a class="" href="https://zukmastore.epizy.com/invoice"> <i class="bi bi-search font-16"></i> <span>Check</span> </a> 
    <a href="https://zukmastore.epizy.com/spin-berhadiah"> <i class="bi bi-gift font-16 rise-shake"></i> <span>Hadiah</span> </a> 
    <a class="active-nav" href="https://zukmastore.epizy.com/"> <i class="bi bi-house-fill font-16"></i> <span>Home</span> </a> 
    <a href="https://zukmastore.epizy.com/tambang-diamond" class=""> <i class="bi bi-gem font-16"></i> <span>Gratis</span> </a> 
    <a class="" href="https://zukmastore.epizy.com/users"> <i class="bi bi-person font-16"></i> <span>Masuk</span> </a> 
   </div> 
   <div id="menu-main" style="width:280px;" class="offcanvas offcanvas-start offcanvas-detached rounded-m"> 
    <div> 
     <div class="card card-style mb-3 rounded-m mt-3" style="height: 150px;" data-card-height="150"> 
      <div class="card-top m-3"> 
       <a href="#" data-bs-dismiss="offcanvas" class="icon icon-xs bg-theme rounded-s color-theme float-end"> <i class="bi bi-caret-left-fill"></i> </a> 
      </div> 
      <div class="card-bottom p-3"> 
       <h1 class="color-white font-20 font-700 mb-n2"></h1> 
       <p class="color-white font-12 opacity-70 mb-n1"></p> 
      </div> 
      <div class="card-overlay rounded-0"></div> 
     </div> 
     <span class="menu-divider">APP</span> 
     <div class="menu-list"> 
      <div class="card card-style rounded-m p-3 py-2 mb-0"> 
       <a href="https://wa.me/6285964243143"> <i class="gradient-green shadow-bg shadow-bg-xs bi bi-whatsapp"></i> <span>Hubungi Admin</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/jual-beli-akun" id="nav-mails"> <i class="gradient-red shadow-bg shadow-bg-xs bi bi-controller"></i> <span>Jual / Beli Akun</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://www.google.com/maps/uv?pb=!1s0x2dd663f196095f87%3A0x138e73226fcdb6e9!5sZukma Store!15sCgIgAQ&amp;imagekey=!1e10!2sAF1QipPCEgAvT-Vij_8uiNvs3JTVorXU-egXFELQ9AbN" target="_blank" id="nav-mails"> <i class="gradient-yellow shadow-bg shadow-bg-xs bi bi-shop"></i> <span>Offline Store</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/testimoni" id="nav-mails"> <i style="background-color: #4267B2" class="shadow-bg shadow-bg-xs bi bi-cart-fill"></i> <span>Testimoni</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://play.google.com/store/apps/details?id=com.zukmastores" target="_blank" id="nav-mails"> <i class="gradient-blue shadow-bg shadow-bg-xs bi bi-phone-fill"></i> <span>Google Playstore</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/faq" id="nav-mails"> <i class="gradient-orange shadow-bg shadow-bg-xs bi bi-chat-dots"></i> <span>FAQ</span> <i class="bi bi-chevron-right"></i> </a> 
      </div> 
     </div> 
     <span class="menu-divider mt-4">Kalkulator</span> 
     <div class="menu-list"> 
      <div class="card card-style rounded-m p-3 py-2 mb-0"> 
       <a href="https://zukmastore.epizy.com/kalkulator-joki" id="nav-mails"> <i style="background-color: #4267B2" class="shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>Kalkulator Joki</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/hitung-wr" id="nav-mails"> <i class="gradient-green shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>Hitung WR</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/hp-magic-wheel" id="nav-mails"> <i class="gradient-blue shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>HP Magic Wheel</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/hp-zodiac" id="nav-mails"> <i class="gradient-orange shadow-bg shadow-bg-xs bi bi-calculator"></i> <span>HP Zodiac</span> <i class="bi bi-chevron-right"></i> </a> 
      </div> 
     </div> 
     <span class="menu-divider mt-4">Bantuan &amp; Sosmed</span> 
     <div class="menu-list" style="margin-bottom: 50px"> 
      <div class="card card-style rounded-m p-3 py-2 mb-0"> 
       <a href="https://www.instagram.com/zukmastores/"> <i style="background-color: #e95950" class="shadow-bg shadow-bg-xs bi bi-instagram"></i> <span>Instagram</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://www.facebook.com/zukmastores"> <i style="background-color: #4267B2" class="shadow-bg shadow-bg-xs bi bi-facebook"></i> <span>Facebook</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://www.tiktok.com/@zukmastores"> <i style="background-color: #000" class="shadow-bg shadow-bg-xs bi bi-tiktok"></i> <span>TikTok</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/terms-conditions"> <i class="gradient-green shadow-bg shadow-bg-xs bi bi-clipboard-check"></i> <span>Terms &amp; Conditions</span> <i class="bi bi-chevron-right"></i> </a> 
       <a href="https://zukmastore.epizy.com/privacy-policy"> <i class="gradient-orange shadow-bg shadow-bg-xs bi bi-clipboard-check"></i> <span>Privacy Policy</span> <i class="bi bi-chevron-right"></i> </a> 
      </div> 
     </div> 
    </div> 
   </div> 
   <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-cs-header2" style="visibility: hidden;" aria-hidden="true"> 
    <div class="content mt-3"> 
     <div class="d-flex pb-2"> 
      <div class="align-self-center"> 
       <h1 class="font-700">Butuh Bantuan ?</h1> 
      </div> 
      <div class="align-self-center ms-auto"> 
       <a href="#" data-bs-dismiss="offcanvas" class="icon icon-m"> <i class="bi bi-x-circle-fill color-red-dark font-18 me-n4"></i> </a> 
      </div> 
     </div> 
     <div class="list-group list-custom list-group-m rounded-xs list-group-flush bg-theme"> 
      <a href="https://wa.me/6285854760492?text=" class="shareToWhatsApp list-group-item" target="_blank"> <i class="bi bi-whatsapp color-whatsapp font-16"></i> 
       <div>
        Customer Service 1
       </div> <i class="bi bi-chevron-right pe-1"></i> </a> 
      <br> 
      <br> 
      <br> 
     </div> 
    </div> 
   </div>
   <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script> 
   <div class="page-content header-clear-medium"> 
    <div class="card card-style mb-3"> 
     <div class="content">
      <div class="d-flex"> 
       <h5>{$dj_label}</h5> 
      </div> 
      <table class="table color-theme mb-2 mt-2"> 
       <tbody>
        <tr> 
         <td>ID Transaksi</td> 
         <td>: {$invoice} <span class="badge bg-primary ms-1" onclick="copy('{$invoice}')" data-toast="done">Salin</span></td> 
        </tr> 
        <tr> 
         <td>Tgl. Pembelian</td> 
         <td>: {$tanggal} WIB</td> 
        </tr> 
        <tr> 
         <td>ID Akun</td> 
         <td>: {$akun}</td> 
        </tr>
        <tr> 
         <td>Nickname</td> 
         <td>: {$nickname}</td> 
        </tr> 
        <tr id="diskon_tr"> 
         <td>Total Pembelian</td> 
         <th class="color-highlight">: Rp {$famount}</th> 
        </tr>
        <tr id="diskon_tr"> 
         <td>Status Pembayaran</td> 
         <th class="color-red-dark">: {$status}</th> 
        </tr> 
       </tbody>
      </table> 
     </div> 
    </div> 
    <div class="card card-style"> 
     <div class="content"> 
      <div class="list-group list-custom list-group-m mb-2"> 
       <span class="list-group-item" onclick="copy('{$kodebayar}')" data-toast="done" aria-expanded="true"> <img src="{$iconbayar}" style="width: 70px; height: 20px; margin-right: 20px;"> 
        <div> 
         <strong style="margin-bottom: 3px;"> {$bayar} </strong> 
         <span> Tap untuk menyalin Kode Pembayaran</span> 
        </div> </span> 
      </div>
      <div class="list-group list-custom list-group-m"> 
       <a class="list-group-item" href="#qris" aria-controls="qris" data-bs-toggle="collapse" aria-expanded="true"> <i class="bi color-red-dark bi-store"></i> 
        <div> 
         <strong>Cara Bayar {$payment}</strong> 
         <span>Tutorial Bayar dengan {$payment}</span> 
        </div> <span class="badge rounded-xl" style="background-color: #9d9d9d" id="payment_label_store"></span> </a> 
       <div id="qris" class="collapse" style=""> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           1. Menuju Ke Kasir {$payment}
         </div> <span class="badge rounded-xl"></span> </a> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           2. Bilang Kak! Mau Bayar Tagihan
         </div> <span class="badge rounded-xl"></span> </a> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           3. Masukan Kode Ke Sistem 
         </div> <span class="badge rounded-xl"></span> </a> 
        <a href="#" class="list-group-item"> 
         <div class="ps-1">
           4. Lalu Cetak Struk Yang Muncul 
         </div> <span class="badge rounded-xl"></span> </a> 
       </div> 
      </div> 
     </div> 
    </div>     
    <div class="card card-style"> 
     <div class="content"> 
      <div class="row"> 
       <div class="col-9"> 
        <span><i class="bi bi-clock" style="margin-right: 5px;"></i> Silahkan selesaikan pembayaran kamu dalam</span> 
       </div> 
       <div class="col-3"> 
        <h6 style="text-align: right;" class="font-14" id="countdown">00:00</h6> 
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="row mt-4" style="margin-right: 30px; margin-left: 30px; margin-bottom: 50px;"> 
     <a href="https://tripay.co.id/checkout/T133727619939VLMPD" class="btn-full btn gradient-red mb-4">Lakukan Pembayaran</a> 
     <center>
       Dengan melanjutkan, Kamu setuju dengan 
      <b class="color-highlight"><a href="https://zukmastore.epizy.com/terms-conditions" target="_blank">Syarat dan Ketentuan</a></b> dan juga 
      <b class="color-highlight"><a href="https://zukmastore.epizy.com/privacy-policy" target="_blank">Kebijakan Privasi</a></b> Zukma Store. 
     </center> 
    </div> 
   </div> 
   <script>
    $("#btn_submit").on('click', e => {

		const payment = $("#payment").val()
		if(payment === ''){
		    
		 $("#notification-danger").addClass('show')
			$("#notification-title").html('Error')
			$("#notification-desc").html("Silahkan pilih metode pembayaran terlebih dahulu")
		}else{
    		location = 'https://zukmastore.epizy.com/change-payment/WUDKC574ML/' + payment
		}
	})

	function changePayment(id, label){

		const payment = $("#payment").val()

		if(payment !== ''){

			$("#payment_select_"+payment).html('')
		}

		$("#payment").val(id)
		$("#payment_label").val(label)
		$("#payment_select_"+id).html('<i class="bi bi-check-circle-fill color-highlight font-16"></i>')
	}
	
	function next(){
	    
	    $("#preloader").attr('class', 'preloader')
	    location = 'https://zukmastore.epizy.com/confirm-payment/WUDKC574ML';
	}
	
	function startTimer(duration) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
    
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
    
            $("#countdown").html(minutes + ":" + seconds);
    
            if (--timer < 0) {
              timer = duration;
            }
        }, 1000);
	}

	startTimer((60-3)*60)

	function copy(text) {
        navigator.clipboard.writeText(text).then(function() {
    
        },function(err) {
    
        }) 
    }
    
	const qrCode = new QRCodeStyling(
        {
          width: 300,
          height: 300,
          data: "",
          margin: 0,
          qrOptions: {
            typeNumber: "0",
            mode: "Byte",
            errorCorrectionLevel: "H"
          },
          imageOptions: {
            hideBackgroundDots: false,
            imageSize: 0.5,
            margin: 0
          },
          dotsOptions: {
            type: "dots",
            color: "#000",
            gradient: {
              type: "linear",
              rotation: 0,
              colorStops: [
                {
                  offset: 0,
                  color: "#000"
                },
                {
                  offset: 1,
                  color: "#000"
                }
              ]
            }
          },
          backgroundOptions: {
            color: "#ffffff",
            gradient: null
          },
          image: "https://zukmastore.epizy.com/assets/logo_shadow.png",
          dotsOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#6a1a4c",
              color2: "#6a1a4c",
              rotation: "0"
            }
          },
          cornersSquareOptions: {
            type: "extra-rounded",
            color: "#d60074"
          },
          cornersSquareOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#000000",
              color2: "#000000",
              rotation: "0"
            }
          },
          cornersDotOptions: {
            type: "",
            color: "#000000"
          },
          cornersDotOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#000000",
              color2: "#000000",
              rotation: "0"
            }
          },
          backgroundOptionsHelper: {
            colorType: {
              single: true,
              gradient: false
            },
            gradient: {
              linear: true,
              radial: false,
              color1: "#ffffff",
              color2: "#ffffff",
              rotation: "0"
            }
          }
        }
    );

    qrCode.append(document.getElementById("qrcode"));
    
    function downloadQR(){
        qrCode.download({ name: "qr_zukmastore", extension: "jpeg" })
    }
</script> 
  </div> 
  <div id="myButton" style="z-index: 99999; margin-bottom: 68px"></div> 
  <div id="notif" class="toast toast-bar toast-top rounded-l shadow-bg shadow-bg-s fade hide" data-bs-delay="3000"> 
   <div class="align-self-center"> 
    <i id="notif_icon" class="icon icon-s  rounded-l bi  font-28 me-2"></i> 
   </div> 
   <div class="align-self-center ps-1"> 
    <strong class="font-13 mb-n2" id="notif_title"></strong> 
    <span class="font-10 mt-n1 opacity-70" id="notif_desc"></span> 
   </div> 
   <div class="align-self-center ms-auto"> 
    <button type="button" class="btn-close btn-close-white me-2 m-auto font-9" data-bs-dismiss="toast"></button> 
   </div> 
  </div> 
  <script src="https://zukmastore.epizy.com/assets/template/bootstrap.min.js"></script> 
  <script src="https://zukmastore.epizy.com/assets/template/custom.js"></script> 
  <script src="https://zukmastore.epizy.com/assets/template/select2.min.js"></script> 
  <script src="https://zukmastore.epizy.com/assets/wa/venom-button.min.js"></script> 
  <script src="https://www.google.com/recaptcha/api.js"></script> 
  <div id="done" class="mb-4 toast toast-pill toast-bottom toast-s rounded-l bg-green-dark shadow-bg shadow-bg-s fade hide" data-bs-delay="2000"> 
   <span class="font-12"><i class="bi bi-hand-thumbs-up-fill font-13"></i> Disalin</span> 
  </div> 
  <div id="notification-danger" class="notification-bar detached gradient-red rounded-s shadow-l fade" data-bs-delay="3000"> 
   <div class="toast-header bg-transparent border-0 rounded-s px-3 py-3 pb-0"> 
    <i class="bi bi-check-circle-fill pe-2 color-white"></i> 
    <strong class="me-auto color-white font-15" id="notification-title"></strong> 
    <a href="#" class="font-10 color-white opacity-60 px-3 me-n3" data-bs-dismiss="toast" aria-label="Close">X</a> 
   </div> 
   <div class="toast-body px-3"> 
    <p class="mb-0 font-12 mt-n1 color-white opacity-70" id="notification-desc"></p> 
   </div> 
  </div> 
  <div id="notif-success" class="notification-bar detached gradient-green rounded-s shadow-l fade" data-bs-delay="3000"> 
   <div class="toast-header bg-transparent border-0 rounded-s px-3 py-3 pb-0"> 
    <i class="bi bi-check-circle-fill pe-2 color-white"></i> 
    <strong class="me-auto color-white font-15" id="notif-title"></strong> 
    <a href="#" class="font-10 color-white opacity-60 px-3 me-n3" data-bs-dismiss="toast" aria-label="Close">X</a> 
   </div> 
   <div class="toast-body px-3"> 
    <p class="mb-0 font-12 mt-n1 color-white opacity-70" id="notif-desc"></p> 
   </div> 
  </div> 
  <div id="toast-danger" class="toast toast-bar toast-top rounded-l bg-red-dark shadow-bg shadow-bg-s fade hide" data-bs-delay="3000"> 
   <div class="align-self-center"> 
    <i class="icon icon-s bg-white color-red-dark rounded-l shadow-s bi bi-exclamation-triangle-fill font-22 me-3"></i> 
   </div> 
   <div class="align-self-center"> 
    <strong class="font-13 mb-n2">Error</strong> 
    <span class="font-10 mt-n1 opacity-70" id="toast-desc"></span> 
   </div> 
   <div class="align-self-center ms-auto"> 
    <button type="button" class="btn-close btn-close-white me-2 m-auto font-9" data-bs-dismiss="toast"></button> 
   </div> 
  </div> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.5/typed.min.js" integrity="sha512-1KbKusm/hAtkX5FScVR5G36wodIMnVd/aP04af06iyQTkD17szAMGNmxfNH+tEuFp3Og/P5G32L1qEC47CZbUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
  <script src="https://zukmastore.epizy.com/assets/template/exp.js"></script> 
  <script>
        $(document).ready(function(){
            
            $('#myButton').venomButton({
                phone: '6285964243143',
                message: "Hallo Min, mau tanya...",
                showPopup: false,
                position: "right",
                linkButton:true,
                size:'60px',
            });

            $('.select_options').select2({
                placeholder: "Pilih Hero",
                allowClear: true
            });
            $('.select_options_multiple').select2({
                multiple: true,
                placeholder: "-- Request Hero (Max: 3) --",
                allowClear: true
            });


            if($(window).width() > 600){
                // paksa jadi mobile
                $("body").css('width', '35%')
                $("body").css('margin', '0 auto')

                $('.header-bar').css('width', '35%')
                $('.header-bar').css('margin', '0 auto')

                $("#footer-bar").css('width', '35%')
                $("#footer-bar").css('margin', '0 auto')
            }

            const cookie = document.cookie.match(/dark/)
            if(Array.isArray(cookie)){
                // light
                $("#bodyhtml").attr('class', 'theme-dark')
                console.log(Array.isArray(cookie))
            }else{
                $("#bodyhtml").attr('class', 'theme-light')
                console.log(Array.isArray(cookie))
            }
            
            

            $(".btn_theme").on('click', e => {

                if($("#bodyhtml").hasClass('theme-light')){
                    
                    // to dark
                    $("#bodyhtml").attr('class', 'theme-dark')
                    document.cookie = 'dark'
                }else {
                    // to light
                    $("#bodyhtml").attr('class', 'theme-light')
                    document.cookie = 'light'
                }
            })

    
                    })
    </script> 
  <!-- <script type="text/javascript">
    (function(d, id) {
    	let js, fjs = d.getElementsByTagName('script')[0];
    	if (d.getElementById(id)) return;
    	js = d.createElement('script'); js.id = id; js.type = 'module';
    	js.src = "https://tripay.co.id/salesproof/sdk?merchant_code=T13372";
    	fjs.parentNode.insertBefore(js, fjs);
    })(document, 'tripay-websocket');
    </script> -->  
 </body>
</html>
HTMLBARUC;

if($payment == "QRISC"){
	$hasil = "$qriszukma";
}elseif($payment == "ALFAMART" || $payment == "INDOMARET" || $payment == "ALFAMIDI"){
	$hasil = "$minimarket";
}else{
	$hasil = "$virtual";
}

$myFile = "c/" . $invoice . ".html";
$fh = fopen($myFile, 'w');
fwrite($fh, $hasil );
fclose($fh);

?>
