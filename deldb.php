<?php 
// error_reporting(0);//禁用错误报告

header("Content-type:text/html;charset=utf-8");

//连接数据库
require_once('conn.php');

// 处理连接错误
try {
	// 连接数据库
	$conn = new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database", $mysql_username, $mysql_password);
	$conn->exec('DELETE FROM data');//删除数据库中数据
	// 现在运行完成，在此关闭连接
    $conn = null;

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

 ?>


<script type="text/javascript">
	alert('删除成功');
	//js返回上个页面并实现刷新。
	location.href = document.referrer;
</script>