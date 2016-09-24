<?php
include './Model/MySQLDB.class.php';
class Model{
	public function getDB(){
		$conf = array(
			'host' => 'localhost',
			'port' => '3306',
			'user' => 'root',
			'pass' => '12345678',
			'charset' => 'utf8',
			'dbname' => 'php',
			);
		$db = MySQLDB::GetDB($conf);
		return $db;
	}
}