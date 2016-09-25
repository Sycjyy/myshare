##PHP 命名空间(namespace)

PHP 命名空间(namespace)是在PHP 5.3中加入的,可以解决以下两类问题：

1.用户编写的代码与PHP内部的类/函数/常量或第三方类/函数/常量之间的名字冲突。

2.为很长的标识符名称(通常是为了缓解第一类问题而定义的)创建一个别名（或简短）的名称，提高源代码的可读性。

###定义命名空间
默认情况下，所有常量、类和函数名都放在全局空间下，就和PHP支持命名空间之前一样。
命名空间通过关键字namespace 来声明。如果一个文件中包含命名空间，它必须在其它所有代码之前声明命名空间。语法格式如下；
```
< ?php  
declare(encoding='UTF-8'); //定义多个命名空间和不包含在命名空间中的代码
namespace MyProject1;  
// MyProject1 命名空间中的PHP代码      
 
// 另一种语法
namespace MyProject2 {  
 // MyProject3 命名空间中的PHP代码    
}  

namespace { // 全局代码
session_start();
$a = MyProject\connect();
echo MyProject\Connection::start();
}
?>  
```
在声明命名空间之前唯一合法的代码是用于定义源文件编码方式的 declare 语句。所有非 PHP 代码包括空白符都不能出现在命名空间的声明之前。

###子命名空间
与目录和文件的关系很象，PHP 命名空间也允许指定层次化的命名空间的名称。因此，命名空间的名字可以使用分层次的方式定义：

```
namespace MyProject\Sub\Level;  //声明分层次的单个命名空间

const CONNECT_OK = 1;
class Connection { /* ... */ }
function Connect() { /* ... */  }

```

上面的例子创建了常量 MyProject\Sub\Level\CONNECT_OK，类 MyProject\Sub\Level\Connection 和函数 MyProject\Sub\Level\Connect。

###命名空间使用
PHP 命名空间中的类名可以通过三种方式引用：

1.非限定名称，或不包含前缀的类名称，例如 $a=new foo(); 或 foo::staticmethod();。如果当前命名空间是 currentnamespace，foo 将被解析为 currentnamespace\foo。如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，则 foo 会被解析为foo。 警告：如果命名空间中的函数或常量未定义，则该非限定的函数名称或常量名称会被解析为全局函数名称或常量名称。

2.限定名称,或包含前缀的名称，例如 $a = new subnamespace\foo(); 或 subnamespace\foo::staticmethod();。如果当前的命名空间是 currentnamespace，则 foo 会被解析为 currentnamespace\subnamespace\foo。如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，foo 会被解析为subnamespace\foo。

3.完全限定名称，或包含了全局前缀操作符的名称，例如， $a = new \currentnamespace\foo(); 或 \currentnamespace\foo::staticmethod();。在这种情况下，foo 总是被解析为代码中的文字名(literal name)currentnamespace\foo。

下面是一个使用这三种方式的实例：
file1.php 文件代码

```
<?php
namespace Foo\Bar\subnamespace; 

const FOO = '我的命名空间是 Foo\Bar\subnamespace<br/>';
function foo() {
	echo '我的命名空间是 '.__NAMESPACE__.'<br/>';
}
class foo
{
    static function staticmethod() {
    	echo '我的命名空间是'.__NAMESPACE__.'<br/>';
    }
}
?>
```

file2.php 文件代码

```
<?php
namespace Foo\Bar;
include 'file1.php';

const FOO = '我的命名空间是 Foo\Bar<br/>';
function foo() {
	echo '我的命名空间是 '.__NAMESPACE__.'<br/>';
}
class foo
{
    static function staticmethod() {
    	echo '我的命名空间是'.__NAMESPACE__.'<br/>';
    }
}

/* 非限定名称 */
foo(); // 解析为 Foo\Bar\foo resolves to function Foo\Bar\foo
foo::staticmethod(); // 解析为类 Foo\Bar\foo的静态方法staticmethod。resolves to class Foo\Bar\foo, method staticmethod
echo FOO; // resolves to constant Foo\Bar\FOO

/* 限定名称 */
subnamespace\foo(); // 解析为函数 Foo\Bar\subnamespace\foo
subnamespace\foo::staticmethod(); // 解析为类 Foo\Bar\subnamespace\foo,
                                  // 以及类的方法 staticmethod
echo subnamespace\FOO; // 解析为常量 Foo\Bar\subnamespace\FOO
                                  
/* 完全限定名称 */
\Foo\Bar\foo(); // 解析为函数 Foo\Bar\foo
\Foo\Bar\foo::staticmethod(); // 解析为类 Foo\Bar\foo, 以及类的方法 staticmethod
echo \Foo\Bar\FOO; // 解析为常量 Foo\Bar\FOO

/* 引用全局空间函数 */
\foo(); //全局函数foo
?>
```
注意访问任意全局类、函数或常量，都可以使用完全限定名称，例如 \foo() 等类和常量。


###namespace关键字和__NAMESPACE__常量
PHP支持两种抽象的访问当前命名空间内部元素的方法，__NAMESPACE__ 魔术常量和namespace关键字。

常量__NAMESPACE__的值是包含当前命名空间名称的字符串。在全局的，不包括在任何命名空间中的代码，它包含一个空的字符串。

关键字 namespace 可用来显式访问当前命名空间或子命名空间中的元素。它等价于类中的 self 操作符。

###使用命名空间：别名/导入
在PHP中，别名是通过操作符 use 来实现的.使用use就要和自动加载的魔术方法__autoload结合。
下面先讲一下自动加载函数，之后再回来使用use。

自动加载的原理，就是在我们new一个class的时候，PHP系统如果找不到你这个类，就会去自动调用本文件中的__autoload($class_name)方法，我们new的这个class_name 就成为这个方法的参数。所以我们就可以在这个方法中根据我们需要new class_name的各种判断和划分就去require对应的路径类文件，从而实现自动加载。

###__autoload的使用
index.php文件
```
function __autoload($className)
{
    require $className . '.php';
}
$db = new DB();
//也是支持静态方法直接调用的
DB::test();
```
DB.php文件
```
class DB
{
    public function __construct()
    {
        echo 'Hello DB <br/>';
    }

    public static function test()
    {
    	echo '静态方法也可以<br/>';
    }
}
```

###spl_autoload_register的使用
小的项目，用__autoload()就能实现基本的自动加载了。但是如果一个项目过大，或者需要不同的自动加载来加载不同路径的文件，这个时候__autoload就悲剧了，原因是一个项目中仅能有一个这样的 __autoload() 函数，因为 PHP 不允许函数重名，也就是说你不能声明2个__autoload()函数文件，否则会报致命错误，我了个大擦，那怎么办呢？放心，你想到的，PHP开发大神早已经想到。
所以spl_autoload_register()这样又一个牛逼函数诞生了，并且取而代之它。它执行效率更高，更灵活.

如何使用：
当我们去new一个找不到的class时，PHP就会去自动调用sql_autoload_resister注册的函数，这个函数通过它的参数传进去：

sql_autoload_resister($param) 这个参数可以有多种形式：
```
sql_autoload_resister('load_function'); //函数名
sql_autoload_resister(array('load_object', 'load_function')); //类和静态方法
sql_autoload_resister('load_object::load_function'); //类和方法的静态调用

//php 5.3之后，也可以像这样支持匿名函数了。
spl_autoload_register(function($className){
    if (is_file('./lib/' . $className . '.php')) {
        require './lib/' . $className . '.php';
    }
});
```
index.php
```
function load1($className)
{
    echo 1;
    require $className . '.php';
}
spl_autoload_register('load1'); //将load1函数注册到自动加载队列中。
$db = new DB(); //找不到DB类，就会自动去调用刚注册的load1函数了
```
上面就是实现了自动加载的方式，我们同样也可以用类加载的方式调用，但是必须是static方法：
```
class autoloading{
    //必须是静态方法，不然报错
    public static function load($className)
    {   
        require $className . '.php';
    }
}
//2种方法都可以
spl_autoload_register(array('autoloading','load')); 
spl_autoload_register('autoloading::load');
$db = new DB(); //会自动找到
```
需要注意的是，如果你同时使用spl_autoload_register和__autoload，__autoload会失效！！！ 再说了，本来就是替换它的，就一心使用spl_autoload_register就好了。

###多个spl_autoload_register的使用
spl_autoload_register是可以多次重复使用的，这一点正是解决了__autoload的短板，那么如果一个页面有多个，**执行顺序是按照注册的顺序，一个一个往下找**，如果找到了就停止。

```
function load1($className)
{
    echo 1;
    if (is_file($className . '.php')) {
        require $className . '.php';
    }
}
function load2($className)
{
    echo 2;
    if (is_file('./app/' . $className . '.php')) {
        require './app/' . $className . '.php';
    }
}
function __autoload($className)
{
    echo 3;
    if (is_file('./lib/' . $className . '.php')) {
        require './lib/' . $className . '.php';
    }
}
//注册了3个
spl_autoload_register('load1');
spl_autoload_register('load2');
spl_autoload_register('__autoload'); 
$db = new DB(); //DB就在本目录下
$info = new Info(); //Info 在/lib/Info.php
```

我们注册了3个自动加载函数。执行结果是
```
1Hello DB
123Hello Info
```
**注意，前面说过，spl_autoload_register使用时，__autoload会无效，有时候，我们希望它继续有效，就可以也将它注册进来，就可以继续使用。**
我们可以打印spl_autoload_functions()函数，来显示一共注册了多少个自动加载：
```
var_dump(spl_autoload_functions());
//数组的形式输出
array (size=3)
  0 => string 'load1' (length=5)
  1 => string 'load2' (length=5)
  2 => string '__autoload' (length=10)
```
###spl_autoload_register自动加载+namespace命名空间 的使用
前面已经说过，自动加载现在是PHP现代框架的基石，基本都是spl_autoload_register来实现自动加载。namespace也是使用比较多的。所以spl_autoload_register + namespace 就成为了一个主流。根据PSR-0的规范，namespace命名已经非常规范化，所以用namespace就能找到详细的路径，从而找到类文件。

我们举例子来看下：

AutoLoading\loading;
```
<?php
namespace AutoLoading;
class loading {
    public static function autoload($className)
    {
        //根据PSR-O的第4点 把 \ 转换成（目录分割符） DIRECTORY_SEPARATOR , 
        //便于兼容Linux文件找。Windows 下（/ 和 \）是通用的
        //由于namspace 很规格，所以直接很快就能找到
       $fileName = str_replace('\\', DIRECTORY_SEPARATOR,  DIR . '\\'. $className) . '.php';
       if (is_file($fileName)) {
            require $fileName;
       } else {
            echo $fileName . ' is not exist'; die;
       }
    }
}

```

上面就是一个自动加载的核心思想方法。下面我们就来spl_autoload_register来注册这个函数：
index.php
```
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
Lib\Name::test();
//定位到App目录下Android目录下的Name.php
App\Android\Name::test();
//定位到App目录下Ios目录下的Name.php
App\Ios\Name::test();
```
由于我们是采用PSR-O方式来定义namespace的命名的，所以很好的定位到这个文件的在哪个目录下了。
APP\Android\Name
```
namespace App\Android;
class Name
{
    public function __construct()
    {
        echo __NAMESPACE__ . "<br>";
    }
    public static function test()
    {
        echo  __NAMESPACE__ . ' static function test <br>';
    }
}
```
所以就会很容易找到文件，并输出：
```
Lib static function test 
App\Android static function test 
App\Ios static function test 
```
好了。基本自动加载的东西就讲完了。很实用的东西。

### 同命名空间下的相互调用
在平时我们使用命令空间时，有时候可能是在同一个命名空间下的2个类文件在相互调用。这个时候就要注意，在自动调用的问题了。

比如Lib\Factory.php 和 Lib\Db\MySQL.php

我想在 Lib\Factory.php 中调用 Lib\Db\MySQL.php。怎么调用呢？以下是错误的示范：
```
new Lib\Db\MySQL();  
//报错，提示说 D:\wamp\www\testphp\module\Lib\Lib\Db\MySQL.php is not exist
```
看到没？这种方式是在Lib\命名空间的基础上来加载的。所以会加载2个Lib。这种方式相当于相对路径在加载。

正确的做法是，如果是在同一个命名空间下平级的2个文件。可以直接调用，不用命名空间。
```
new MySQL(); //直接这样就可以了。
new Db\MySQL(); //如果有个Db文件夹,就这样。
```
还有一种方法就是使用 use 。使用user就可以带上Lib了。**use使用的是绝对路径。**
```
use Lib\Db\MySQL;
new MySQL();
```
我想在 Lib\Db\MySQL.php 中调用 Lib\Register.php。怎么调用呢？

应该这样
```
use Lib\Register;
Register::getInstance();
```
因为现在已经在Lib\Db这样一个命名空间了，如果你不用use，而是使用Lib\Register::getInstance()或者使用Register::getInstance()的话。将是在Lib\Db这个空间下进行相对路径的加载，是错误的。

##总结
- 命名空间的三种引用方式：非限定名称、限定名称、完全限定名称。
- 项目中命名空间要按照文件目录的结构命名，方便自动加载过程中找到文件。
- 在使用的过程尽量使用use，即使同命名空间下。use使用的是绝对路径。
- 类名要和文件名要相同，或者设置一定的规则，因为通过类的创建自动去加载文件。