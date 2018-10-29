<!-- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>水庫安全管理系統</title>
    <link rel="stylesheet" href="reservoir2/dist/style/style.min.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="xtreme-admin/assets/images/favicon.png">
<!--    <link type="text/css" rel="stylesheet" href="css/waitMe.css">-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="reservoir2/dist/script/lodash.min.js" type="text/javascript"></script>
    <script src="reservoir2/dist/script/script.js" type="text/javascript"></script>
</head>
<body>
<div class="page">
    <div class="nav">
        <div class="logo">
            <img src="reservoir2/dist/image/logo.svg" alt="logo">
        </div>
        <div class="btn-hamburger">
            <span class="hamburger"></span>
        </div>
        <ul class="nav-list">
            <li class="login">
                <a href="#" class="btn btn-login" onclick="history.back()">返回</a>
            </li>
        </ul>
    </div>

    <div class="main">

<?php
	$dd=file_get_contents("https://www.cwb.gov.tw/V7/modules/MOD_EC_Home.htm?_=".time());
	$nn=preg_match_all('/<td nowrap="nowrap">[0-9]+?<\/td>.+?<td style="display:none">([A-Z0-9]+?).htm<\/td>/si', $dd, $cc);
	// echo "Count:".$nn;
//	for($i=0;$i<$nn;$i++){
//		echo "<img src='https://www.cwb.gov.tw/V7/earthquake/Data/quake/".$cc[1][$i]."_H.png'><br>";
		//如果只要抓最新的就把變數帶$cc[1][0]就好
		//檔名尾端的規則：
		//_H.png => 高解析度的圖
		//.gif => 低解析度的圖
		//_org.gif => 原始報告圖
//	}
		echo "<img src='https://www.cwb.gov.tw/V7/earthquake/Data/quake/".$cc[1][0]."_H.png'><br>";
?>

    </div>
</div>
</body>
</html>
