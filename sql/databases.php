<?php 
$link = @mysql_connect("localhost","root","12345678") or die("连接数据库失败！");
mysql_query("set names utf8");
//执行语句要用变量接收再执行mysql_query()语句
$sql = "show databases;";
$result = mysql_query($sql);

if ($result === false) {
	echo "查询失败！错误：".mysql_error();
}else{
	echo "查询结果：";
	//表头就是对应的列的字段名
	echo "<table border = '1'>";
	echo "<tr>";
	$c = mysql_num_fields($result);
	for ($i=0; $i < $c; $i++) { 
		$name = mysql_field_name($result, $i);
		echo "<th>".$name."</th>";
	}
	echo "<th>操作</th>";
	echo "</tr>";
	while ($rec = mysql_fetch_array($result)) {
			echo "<tr>";
			for ($i=0; $i < $c; $i++) { 
				$name = mysql_field_name($result, $i);
				echo "<td>".$rec[$name]."</td>";
			}
			echo "<td><a href = 'tables.php?db={$rec[$name]}'>查看表</a></td>";
			echo "</tr>";
		}	
}


?>