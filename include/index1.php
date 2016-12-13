<?php
header('Content-Type:text/html;charset=utf-8');
// include './Controller/Controller.class.php';
// $pdo = new PDO("mysql:host=localhost;dbname=boxue","root","12345678");
date_default_timezone_set('UTC');
function StrCode($string,$action='ENCODE'){
        $string = ''.$string;
        $action!= 'ENCODE' && $string = base64_decode($string);
        $code   = '';
        $key    = substr(md5('mathleague'),8,18);
        $keyLen = strlen($key);
        $strLen = strlen($string);
        for($i=0;$i<$strLen;$i++){
                $k = $i % $keyLen;
                $code.=$string[$i] ^ $key[$k];
        }
        return ($action != 'DECODE' ? base64_encode($code) : $code);
    }
    // StrCode('416');
var_dump(StrCode('2'));
var_dump(StrCode('34567'));
var_dump(StrCode('Vw==','DECODE'));
var_dump(StrCode('VlcFBQ8=','DECODE'));
        // var_dump(date('Y-m-d H:i:s',time()));
        // $redis = new Redis();
        // $redis->connect('127.0.0.1','6379');//redis服务器ip及端口号
        // $res = $redis->set('username','uuke');//设置缓存:键-值-缓存时间
        // $username = $redis->get('username');//查找缓存
        // var_dump($username);
        // $redis->del($key);//删除缓存
        // $redis->delete($key);//删除缓存

    $mongo = new 


 // echo date('H',1478059472 - time());

?>

<div onclick="alert('1')" style="pandding:20px">
    <div onclick="alert('2')"><button>1</button></div>
    <div onclick="alert('3')"><button>2</button></div>
</div>

