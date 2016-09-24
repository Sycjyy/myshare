<?php

// include 'file2.php';

// function foo(){
// 	echo '我是全局空间';
// }


function __autoload($className)
{
    require $className . '.php';
}
$db = new DB();
//也是支持静态方法直接调用的
DB::test();


