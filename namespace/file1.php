<?php
// namespace Foo\Bar\subnamespace; 

const FOO = '我的命名空间是 Foo\Bar\subnamespace<br/>';
function foo() {
	echo '我的命名空间是 '.__NAMESPACE__.'dd <br/>';
}
class foo
{
    static function staticmethod() {
    	echo '我的命名空间是'.__NAMESPACE__.'<br/>';
    }
}