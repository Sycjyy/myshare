<?php
header('Content-Type:text/html;charset=utf-8');
// include 'file2.php';

// function foo(){
// 	echo '我是全局空间';
// }


// function __autoload($className)
// {
//     require $className . '.php';
// }
// $db = new DB();
// //也是支持静态方法直接调用的
// DB::test();

function load1($className)
{
    echo 1;
    require $className . '.php';
}
spl_autoload_register('load1'); //将load1函数注册到自动加载队列中。
$db = new DB(); //找不到DB类，就会自动去调用刚注册的load1函数了
