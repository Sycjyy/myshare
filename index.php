<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<ul>
	<li>
		<a href="/myshare/include/index1.php">
		<div class="include">文件包含分享</div>
		</a>
	</li>
	<li>
		<a href="/myshare/autoloading/index.php">
		<div class="namespace">PHP自动加载分享</div>
		</a>
	</li>
	<li>
		<a href="/myshare/namespace/index.php">
		<div class="namespace">命名空间分享</div>
		</a>
	</li>

</ul>
<script type="text/javascript">
	window.onbeforeunload=onclose; 
	// window.onclose = function(){
		function onclose(){
			alert('bye');
		}
</script>