<?php

echo '我是dir2中的file2.php<br/>';

//下面这样写会出错，相对于include_test.php文件file1.php的路径应该是'./dir1/file1.php'
// include '../dir1/file1.php';
include './dir1/file1.php';