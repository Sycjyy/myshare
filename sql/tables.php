<?php

if (!empty( $_GET['db'] )) {
	$db = $_GET['db'];

	mysql_connect("localhost","root","123456");
	mysql_query("set names utf8");
	mysql_query("use $db");

	$sql = "show tables;";
	$result = mysql_query($sql);
	if ($result === false) {
		echo "查表失败!错误：".mysql_error();
	}else{
		echo "查询结果：";
		echo "<table border = '1'>";
		//表头
		echo "<tr>";
		$c = mysql_num_fields($result);
		for ($i=0; $i < $c; $i++) { 
			$name = mysql_field_name($result, $i);
			echo "<th>".$name."</th>";
		}
		echo "<th colspan = 2>操作</th>";
		//表内容
		while ($rec = mysql_fetch_assoc($result)) {
			echo "<tr>";
			for ($i=0; $i < $c; $i++) { 
				$name = mysql_field_name($result, $i);
				echo "<td>".$rec[$name]."</td>";
			}
			echo "<td><a href = 'table_struct.php?db=$db&table={$rec[$name]}'>查看结构</a></td>";
			echo "<td><a href = 'table_data.php?db=$db&table={$rec[$name]}'>查看数据</a></td>";
			echo "<tr>";
		}
		
	}

}else{
	echo "传递参数有误！";
}


?>