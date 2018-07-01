<?php 
error_reporting(0);//禁用错误报告

header("Content-type:text/html;charset=utf-8");


//连接数据库
require_once('conn.php');
$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password); 
mysql_query("set names 'utf8'"); //数据库输出编码
mysql_select_db($mysql_database); //打开数据库

// 删除数据库中数据
mysql_query("DELETE FROM data");

// 关闭MySQL连接
mysql_close($conn);

 ?>


<script type="text/javascript">

	alert('删除成功');
	window.location.href="http://pkp.com/"; 

</script>