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

<body>
<?php 
mysql_connect("localhost","root","123456");
mysql_query("set names utf8");
mysql_query("use php");

if (!empty($_POST['submit'])) {
	$name = $_POST['name'];
	$pass = $_POST['pass'];
	$age = $_POST['age'];
	$edu = $_POST['edu'];
	$hobby = $_POST['hobby'];
	//数组是类似于‘1’，‘2’，‘8’，要求和
	//$hobby_list = implode(",", $hobby);
	$hobby_sum = array_sum($hobby);
	$from = $_POST['come_from'];

	$sql = "insert into user (user_name,pass,age,edu,inter,addr) values(";
	$sql .="'$name','$pass','$age','$edu','$hobby_sum','$from');";
	$result = mysql_query($sql);
	if ($result ===false) {
		echo "发生错误：".mysql_error();
		echo "错误语句：".$sql;
	}else{
		echo "<font color='red'>执行成功</font>";
		echo "<br/>";
	}
}

if (!empty($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "delete from user where id = $id";
	$result = mysql_query($sql);
	if ($result === false) {
		echo "发生错误：".mysql_error();
	}else{
		echo "<font color='red'>删除成功</font><br/>";
	}
}

?>

	<b>添加数据</b>
	<form action="" name="user" method="post">
		<label>用户名：</label>
		<input type="text" name="name" />
		<br/>
		<label>密&nbsp &nbsp码：</label>
		<input type="password" name="pass" />
		<br/>
		<label>年&nbsp &nbsp龄：</label>
		<input typy="text" name="age" />
		<br/>
		<label>学&nbsp &nbsp历：</label>
		<select name="edu">
			<option value="">请选择</option>uo
			<option value="1">博士</option>
			<option value="2">硕士</option>
			<option value="3">本科</option>
			<option value="4">高中</option>
		</select>
		<br/>
		<label>兴&nbsp &nbsp趣：</label>
		<input type="checkbox" name="hobby[]" value="1"/>排球
		<input type="checkbox" name="hobby[]" value="2"/>篮球
		<input type="checkbox" name="hobby[]" value="4"/>足球
		<input type="checkbox" name="hobby[]" value="8"/>中国足球
		<input type="checkbox" name="hobby[]" value="16"/>地球
		<br/>
		<label>来&nbsp &nbsp自：</label>
		<input type="radio" name="come_from" value="东北" />东北
		<input type="radio" name="come_from" value="华北" />华北
		<input type="radio" name="come_from" value="西北" />西北
		<input type="radio" name="come_from" value="华东" />华东
		<input type="radio" name="come_from" value="华南" />华南
		<input type="radio" name="come_from" value="华西" />华西
		<br/>
		<input type="submit" name="submit"value="o k">

	</form>
<?php

$sql = "select * from user;";
$result = mysql_query($sql);
if ( $result ===false ) {
	echo "发生错误：".mysql_error();
}else{
	echo "数据显示：<br/>";
	echo "<table border = '1'>";
		echo "<tr>";
		echo "<th>用户名</th>";
		echo "<th>年龄</th>";
		echo "<th>学历</th>";
		echo "<th>爱好</th>";
		echo "<th>来自</th>";
		echo "<th>注册时间</th>";
		echo "<th>操作</th>";
		echo "</tr>";
		while ($rec = mysql_fetch_array($result)) {
			echo "<tr>";
			echo "<td>{$rec['user_name']}</td>";
			echo "<td>{$rec['age']}</td>";
			echo "<td>{$rec['edu']}</td>";
			echo "<td>{$rec['inter']}</td>";
			echo "<td>{$rec['addr']}</td>";
			echo "<td>{$rec['reg_time']}</td>";
			echo "<td><a href='user.class.php?id={$rec['id']}'>删除</a></td>";
			echo "</tr>";
		}
	echo "</table>";
}

$sql = "select count(*) as 用户总数 from user;";
$result = mysql_query($sql);
$rec = mysql_fetch_array($result);
$c = $rec[0];
echo "用户总数：".$c;

?>


</body>
</html>