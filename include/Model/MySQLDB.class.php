<?php
class MySQLDB{
	private $host;
	private $port;
	private $user;
	private $pass;
	private $charset;
	private $dbname;

	public $link = null;//用于储存‘连接资源’

	/*----------------做成单例模式--------------*/
	private function __clone(){}        //1
	private static $db = null;          //2
	static function GetDB($conf){       //3
		if (!isset(self::$db)) {
			self::$db = new self($conf);
		}
		return self::$db;
	}
	private function __construct($conf){ //4
		$this->host = $conf['host'];
		$this->port = $conf['port'];
		$this->user = $conf['user'];
		$this->pass = $conf['pass'];
		$this->charset = $conf['charset'];
		$this->dbname = $conf['dbname'];
		$this->link = mysql_connect("{$this->host}:{$this->port}",$this->user,$this->pass) or die("连接失败！");
		mysql_query("set names {$this->charset}");
		mysql_query("use {$this->dbname}");
	}
	/*----------------做成单例模式--------------*/

	//选择使用哪个数据库
	function select_db($db){
		$this->dbname = $db;
		mysql_query("use {$this->dbname}");
	}
	//判断是否连接服务器成功
	function isConnect(){
		if ($this->link) {
			return true;
		}else{
			return false;
		}
	}
	//断开服务器连接
	function close(){
		mysql_close($this->link);
	}
	//执行增删改语句操作
	function exec($sql){
		$result = $this->query($sql);
		return true;
	}
	//得到一行数据，返回一维数组
	function GetOneRow($sql){
		$result = $this->query($sql);
		$rec = mysql_fetch_assoc($result);
		return $rec;
	}
	//得到多行数据，返回二维数组
	function GetRows($sql){
		$result = $this->query($sql);
		$arr = array();
		while ($rec = mysql_fetch_array($result)) {
			$arr[] = $rec;
		}
		return $arr;
	}
	//得到一行一列数据，返回一个标量数据
	function GetOneData($sql){
		$result = $this->query($sql);
		$rec = mysql_fetch_row($result);
		return $rec[0];
	}
	//执行语句，判断结果真假并返回结果
	private function query($sql){
		$result = mysql_query($sql);
		if ($result === false) {
			echo "<p>发生错误，相关信息如下：</p>";
			echo "错误代号：".mysql_errno();
			echo "错误提示：".mysql_error();
			echo "错误语句：".$sql;
			die();
		}
		return $result; 
	}
}


