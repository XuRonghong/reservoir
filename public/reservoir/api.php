<?php
	error_reporting(0);
	$_SERVER["db"]=array();
	$_SERVER["db"]["hostname"]="220.128.126.117";		//MySQL資料庫位置
	$_SERVER["db"]["username"]="app";			//MySQL資料庫帳號
	$_SERVER["db"]["password"]="test";	//MySQL資料庫密碼
	$_SERVER["db"]["name"]="shakemap";			//MySQL資料庫名稱
	function by_db($q=false,$p=array()){
		static $db=false;
		if($db===false){
			try{
				$db=new pdo("mysql:host=".$_SERVER["db"]["hostname"],$_SERVER["db"]["username"],$_SERVER["db"]["password"],array(PDO::ATTR_PERSISTENT=>false));
			}catch(PDOException $e){
				echo $e->getMessage();
				exit();
			}
			$db->exec("set names 'utf8'");
			$db->exec("SET GLOBAL time_zone = '+8:00'");
			$db->exec("use `".$_SERVER["db"]["name"]."`");
		}
		if($q===false){
			return $db;
		}
		if(is_array($p)==false){
			$p=array($p);
		}
		$n=$db->prepare($q);
		$n->execute($p);
		return $n;
	}
	$returnList=array();
	$returnList["type"]="event";
	$returnList["data"]=by_db("SELECT * FROM `event` WHERE  `eventTime`>='".date("Y-m-d H:i:s",time()-32400)."' ORDER BY `eventTime` DESC LIMIT 0,45")->fetchAll(PDO::FETCH_ASSOC);
	if(count($returnList["data"])==0){
		$returnList["type"]="normal";
		$returnList["data"]=by_db("SELECT * FROM `shakemap` WHERE (`id` LIKE 'SD%' OR `id` LIKE 'MD%') ORDER BY `id` ASC")->fetchAll(PDO::FETCH_ASSOC);
	}
	echo json_encode($returnList);
	exit();
?>