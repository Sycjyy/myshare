<?php
namespace Foo\Bar;
use Foo\Bar\subnamespace;
function foo() {
	foo::staticmethod();
	echo '全局函数foo<br/>';
}
class foo
{
    static function staticmethod() {
    	
    	echo '全局下foo类的静态方法<br/>';
    }
}