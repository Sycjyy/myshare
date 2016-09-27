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

// function load1($className)
// {
//     echo 1;
//     require $className . '.php';
// }
// spl_autoload_register('load1'); //将load1函数注册到自动加载队列中。
// $db = new DB(); //找不到DB类，就会自动去调用刚注册的load1函数了

// class autoloading{
//     //必须是静态方法，不然报错
//     public static function load($className)
//     {   
//         require $className . '.php';
//     }
// }
// //2种方法都可以
// // spl_autoload_register(array('autoloading','load')); 
// spl_autoload_register('autoloading::load');
// $db = new DB(); //会自动找到


//定义当前的目录绝对路径
define('DIR', dirname(__FILE__));
//加载这个文件
require DIR . '/autoloading.php';
//采用`命名空间`的方式注册。php 5.3 加入的
//也必须是得是static静态方法调用，然后就像加载namespace的方式调用，注意：不能使用use
spl_autoload_register("\\AutoLoading\\loading::autoload"); 
// 调用三个namespace类
//定位到Lib目录下的Name.php 
// var_dump(spl_autoload_functions());
// Lib\Name::test();
// //定位到App目录下Android目录下的Name.php
// App\Android\Name::test();
// //定位到App目录下Ios目录下的Name.php
// App\Ios\Name::test();


new Lib\Factory();
// Lib\Db\MySQL::test();

/*
PSR-0 下面描述了具体互操作性的自动加载所必须的条件：
一个完全合格的namespace和class必须符合这样的结构 \<Vendor Name><Namespace>*<Class Name>
每个namespace必须有一个顶层的namespace（"Vendor Name"提供者名字）
每个namespace可以有多个子namespace
当从文件系统中加载时，每个namespace的分隔符要转换成 DIRECTORY_SEPARATOR(操作系统路径分隔符)
在CLASS NAME（类名）中，每个下划线(_)符号要转换成DIRECTORY_SEPARATOR。在namespace中，下划线(_)符号是没有（特殊）意义的。
当从文件系统中载入时，合格的namespace和class一定是以 .php 结尾的
verdor name,namespaces,class名可以由大小写字母组合而成（大小写敏感的）
*/