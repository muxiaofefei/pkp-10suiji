<a href="/">返回</a>

<?php 

header("Content-type:text/html;charset=utf-8");

//禁用错误报告
// error_reporting(0);

require_once('conn.php');

$id = $_GET["id"];

// 处理连接错误
try {
	// 连接数据库
	$conn = new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database", $mysql_username, $mysql_password);
	$conn->exec('set names utf8');//设置数据库编码
	 foreach($conn->query("SELECT * from `pkp`.`data` where id =$id") as $row) {
        // print_r($row);
    }

	echo "<h1>".substr($row['creatime'],0,10)."</h1>";
	echo $row['pkp'];
	echo "<hr>";
	$haoma = explode('-',$row['pkp']);
	$dir="./images/";
	$file=scandir($dir);
	array_splice($file,0,2); 
	array_splice($haoma,0,1); 

	$i=0;
	foreach($haoma as $numbers){
		$i++;	
		?>
		<img width="100" src="./images/<?=$file[$numbers] ?>">
		<?php
		if($i == 6){
			echo "<br>";
			$i = 0;
		}
	}


	// 现在运行完成，在此关闭连接
    $conn = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}






