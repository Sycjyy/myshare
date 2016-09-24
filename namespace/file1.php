<?php
namespace Foo\Bar\subnamespace; 

const FOO = "Foo\Bar\subnamespace-1";
function foo() {
	echo __NAMESPACE__.'-foo-function<br/>';
}
class foo
{
    static function staticmethod() {
    	echo __NAMESPACE__.'-foo-class-staticmethod<br/>';
    }
}