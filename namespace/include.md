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
在PHP中，别名是通过操作符 use 来实现的.使用use就要和自动加载函数__autoload结合。
下面先讲一下自动加载函数。