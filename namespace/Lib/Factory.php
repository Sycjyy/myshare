<?php
namespace Lib;
use Lib\Db\MySQL;
class Factory{
	public function __construct()
    {
        echo __NAMESPACE__ . "<br>";
        new MySQL();
    }
    public static function test()
    {
        echo  __NAMESPACE__ . ' static function test <br>';
    }
}
