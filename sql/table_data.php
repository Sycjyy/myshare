<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Thansitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-cn">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>表数据</title>
	<meta name="keywords" content="关键字列表"/>
	<meta name="description" content="网页描述"/>
	<link rel="stylesheet" type="text/css" href=" " />
	<style type="text/css"></style>
	<script type="text/javascript"></script>
</head>
<body>

<?php
include "./MySQLDB.class.php";
include_once './u';
if ($_GET['db']&&$_GET['table']) {
	$db = $_GET['db'];
	$table = $_GET['table'];
	mysql_connect("localhost","root","123456");
	mysql_query("set names utf8");
	mysql_query("use $db;");
	$sql = "select * from $table;";
	$result = mysql_query($sql);

	if ($result === false) {
		echo "查询失败！";
	}else{
		echo "查询结果：";
		$c = mysql_num_fields($result);
		echo "<table border = '1'>";
		echo "<tr>";
		for ($i=0; $i < $c; $i++) { 
			$name = mysql_field_name($result, $i);
			echo "<th>".$name."</th>";
		}
		echo "</tr>";
		while ($rec = mysql_fetch_assoc($result)) {
			echo "<tr>";
			for ($i=0; $i < $c; $i++) { 
				$name = mysql_field_name($result, $i);
				echo "<td>".$rec[$name]."</td>";
			}
			echo "</tr>";
		}
	}
}

?>

</body>
</html>