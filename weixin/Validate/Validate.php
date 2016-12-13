<?php

namespace Validate;

class Validate
{
	private $token = 'momowuwen';

	public static function validate(){
		
	//1.获得微信发过来的数据
	$signature = $_GET['signature'];
	$timestamp = $_GET['timestamp'];
	$nonce = $_GET['nonce'];
	$echostr = $_GET['echostr'];
	//2.处理signature
	$token = 'momowuwen';

	$tmpArr = array($timestamp,$nonce,$token);
	sort($tmpArr,SORT_STRING);
	$tmpStr = implode($tmpArr);
	$tmpStr = sha1($tmpStr);

	if ($tmpStr == $signature) {
	 	echo $echostr;
	 } else{
	 	echo 'ERROR';
	 }
	}
}