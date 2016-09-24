<?php
namespace Foo\Bar;
include 'file1.php';
// use Foo\Bar\subnamespace;

const FOO = 'Foo\Bar-2';
function foo() {
	echo __NAMESPACE__.'-foo-function'.'<br/>';
}
class foo
{
    static function staticmethod() {
    	echo __NAMESPACE__."-foo-class-staticmethod<br/>";
    }
}

/* 非限定名称 */
foo(); // 解析为 Foo\Bar\foo resolves to function Foo\Bar\foo
foo::staticmethod(); // 解析为类 Foo\Bar\foo的静态方法staticmethod。resolves to class Foo\Bar\foo, method staticmethod
echo FOO."<br/>"; // resolves to constant Foo\Bar\FOO

/* 限定名称 */
subnamespace\foo(); // 解析为函数 Foo\Bar\subnamespace\foo
subnamespace\foo::staticmethod(); // 解析为类 Foo\Bar\subnamespace\foo,
                                  // 以及类的方法 staticmethod
echo subnamespace\FOO."<br/>"; // 解析为常量 Foo\Bar\subnamespace\FOO
                                  
/* 完全限定名称 */
\Foo\Bar\foo(); // 解析为函数 Foo\Bar\foo
\Foo\Bar\foo::staticmethod(); // 解析为类 Foo\Bar\foo, 以及类的方法 staticmethod
echo \Foo\Bar\FOO."<br/>"; // 解析为常量 Foo\Bar\FOO
