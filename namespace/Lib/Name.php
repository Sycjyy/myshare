<?php
namespace Lib;

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