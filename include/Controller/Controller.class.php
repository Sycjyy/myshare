<?php
include './Model/Model.class.php';
$model = new Model();
$db = $model ->getDB();
$sql = 'select *from stu;';   //数据库查询语句
$result = $db ->GetRows($sql);//调用MySQLDB类的对象方法
include './View/view.html';