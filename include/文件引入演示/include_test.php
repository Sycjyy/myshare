<?php
/**
 * Created by PhpStorm.
 * User: sycjyy
 * Date: 16/9/8
 * Time: 下午4:49
 */

echo '文件引入测试<br/><hr/><hr/>';

echo '引入失败报错<br/><hr/>';
include './mysql.class.php';//没有这个文件
echo '我出现就表示程序继续执行了，没出现就表示程序终止了';
// //
// require './mysql.class.php';//没有这个文件
// echo '我出现就表示程序继续执行了，没出现就表示程序终止了';

echo '引入路径测试<br/><hr/>';
echo "相对路径<br/>";
include "./dir2/file2.php";

echo "绝对路径<br/>";
// 第一种直接写绝对路径
include "/Users/sycjyy/Sites/sqltest/dir2/file2.php";
echo '<br/>';//换行作用
// 第二种用dirname(__FILE__)
$dir = dirname(__FILE__);//计算出来的也是一个绝对路径形式的目录，但是要注意__FILE__是一个Magic constants，不管在什么时候都等于写这条语句的php文件所在的绝对路径
include $dir.'/dir2/file2.php';
echo '<br/>';
echo "未确定路径<br/>";
// include 'file2.php';
// include 'MySQLDB.class.php';

//演示实例
$link = @mysql_connect('localhost','root','12345678') or die('连接数据库失败');//连接数据库
mysql_query("set names utf8");//设置字符集
mysql_query("use php;");//选择数据库
$sql = 'select *from stu;';
$re = mysql_query($sql);//执行查询语句
//将查询结果转换成二维数组
$result = array();
while ($rec = mysql_fetch_array($re)) {
	$result[] = $rec;
}

include_once '../Model/MySQLDB.class.php';
$conf = [
    'host' => 'localhost',
    'port' => '3306',
    'user' => 'root',
    'pass' => '12345678',
    'charset' => 'utf8',
    'dbname'  => 'php'
];
$db = MySQLDB::GetDB($conf);  //创建一个数据库类的对象

$sql = 'select *from stu;';   //数据库查询语句
$result = $db ->GetRows($sql);//调用MySQLDB类的对象方法

include '../View/view.html';
?> 
<table> 
	<tr>
		<td>id</td>
		<td>姓名</td>
		<td>性别</td>
	</tr>
<?php foreach ($result as $key => $value) { ?>
	<tr>
		<td><?php echo $value['id'] ?></td>
		<td><?php echo $value['name'] ?></td>
		<td><?php echo $value['gender'] ?></td>
	</tr>
<?php } ?> 
</table> 


