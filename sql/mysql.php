<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>PHP与数据库之间的连接与操作</title>

</head>
<body>

<?php 

//演示PHP中操作mysql的基本用法
$link = @mysql_connect("localhost","root","123456") or die("连接失败！");
if ($link) {
	mysql_query("set names utf8;");

	$use = mysql_query("use php;");
	if ($use) {
		echo "use php success";
	}else{
		echo "use php failed";
	}

}
//演示enum类型数据插入
$sql = "create table enum_test(id int auto_increment primary key,jiguan enum('黑龙江','山西','陕西','北京') ); ";
$sql = "insert into enum_test(id,jiguan)values(null, '山西');";
//演示mysql_fetch
$sql = "select * from student;";
$result = mysql_query($sql);
if ($result === false) {
	echo "<br/>错误：".mysql_error();
}else{
	echo "执行成功，数据如下：" ;
	echo "<table border = '1'>";
	while ($rec = mysql_fetch_array($result)) {
		echo "<tr>";
		// echo "<td>".$rec['id']."</td>";
		// echo "<td>".$rec['name']."</td>";
		// echo "<td>".$rec['pass']."</td>";
		// echo "<td>".$rec['post_code']."</td>";
		// echo "<td>".$rec['age']."</td>";
		// echo "<td>".$rec['birthday']."</td>";
		
		echo "</tr>";
	}
}

?>

</body>
</html>


