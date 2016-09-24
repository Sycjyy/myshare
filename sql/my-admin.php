<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Thansitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-cn">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>用户列表</title>
	<meta name="keywords" content="关键字列表"/>
	<meta name="description" content="网页描述"/>
	<link rel="stylesheet" type="text/css" href=" " />
	<style type="text/css"></style>
	<script type="text/javascript"></script>
</head>
<?php
//设置变量接收操作和数据库和表
$db = !empty($_GET['db'])? $_GET['db'] : " ";
$action = !empty($_GET['action'])? $_GET['action'] : "";

//连接数据库
mysql_connect("localhost","root","123456");
mysql_query("set names utf8");

//根据不同操作设置不同的操作语句
if ($action == "struct") {
	mysql_query("use $db");
	$sql = "desc {$_GET['table']} ;";
}else if ($action == "data") {
	mysql_query("use $db");
	$table = $_GET['table'];
	$sql = "select * from $table ;";
}else if ($action == "drop") {
	mysql_query("use $db");	
	$table = $_GET['table'];
	$sql = "drop table if exists $table;";
	$result = mysql_query($sql);
	if ($result) {
		
	}else{
		echo "失败！";
	}
	$sql = "show tables;";
	$action = "show_tables";
}else if ($action == "show_tables") {
	mysql_query("use $db");
	$sql = "show tables;";
}else{
	$sql = "show databases;";
}
//执行操作语句，显示结果
$result = mysql_query($sql);
if ($result === false) {
	echo "错误：".mysql_error();
}else{
	echo "执行成功，数据如下：";
	echo "<table border = '1'>";
	echo "<tr>";
	$c = mysql_num_fields($result);
	for ($i=0; $i < $c; $i++) { 
		$name = mysql_field_name($result, $i);
		echo "<th>".$name."</th>";
	}
	if ($action == "struct" || $action == "data" || $action == "drop") {
		
	}else{
		echo "<th>操作</th>";
	}
	echo "</tr>";
	while ($rec = mysql_fetch_array($result)) {
		echo "<tr>";
		for ($i=0; $i < $c; $i++) { 
			$name = mysql_field_name($result, $i);
			echo "<td>".$rec[$name]."</td>";
		}
		if ($action == "struct" || $action == "data" || $action == "drop") {
			
		}else if ($action == "show_tables") {
			echo "<td><a href='?action=struct&db=$db&table={$rec[$name]}'>查看结构</a>";
			echo "&nbsp<a href = '?action=data&db=$db&table={$rec[$name]}'>查看数据</a>";
			//echo "&nbsp<a href = '?action=drop&db=$db&table={$rec[$name]}'>删除表</a></td>";
		}else{
			echo "<td><a href='?action=show_tables&db={$rec[$name]}'>查看表</a></td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

?>


</html>