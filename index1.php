<?php 
// error_reporting(0);//禁用错误报告

header("Content-type:text/html;charset=utf-8");

?>
<h1>今日数据</h1>

<a href="#" onclick="javascropt:location.href = document.referrer;">返回</a>
<hr>


<?php
date_default_timezone_set("Asia/Shanghai");//设置时间为中国时间

$today = date("Y-m-d");//获取今天的日期
// print($today);die;
// $today ='2019-09-19';


//连接数据库
require_once('conn.php');

// 处理连接错误
try {
	// 连接数据库
	$conn = new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database", $mysql_username, $mysql_password);
	$conn->exec('set names utf8');//设置数据库编码
	 foreach($conn->query("SELECT * from `pkp`.`data` where creatime like '$today%' ORDER BY `creatime`") as $row) {
        // print_r($row);
    }

	$numbers = range (0,53); // — 建立一个包含0-53的数组 
	shuffle ($numbers); //shuffle 将数组顺序随即打乱 

	//54张扑克牌
	// $num=54; //设置截取的个数
	$num = 3;

	$result = array_slice($numbers,0,$num); //array_slice 取该数组中的某一段 
	$dir="./images/";//图片存放路径
	$file=scandir($dir);//读取图片文件夹下的图片名称
	array_splice($file,0,2); //删除./和../两个目录
	foreach($result as $numbers){
	    @$haoma = $haoma.'-'.$numbers;//将10个随机数用-进行拼接
	}

	//如果数据库中没有今天日期则写入数据
	$riqi = date("Y-m-d H:i:s",time());
	if(@$row['creatime'] == ""){
	    $sql = "insert into data (pkp,creatime) values ('$haoma','$riqi')";
	    $conn->exec($sql);

	    $todayhaoma = explode('-', $haoma);
	    array_splice($todayhaoma,0,1); 

	    echo $haoma;
	    echo "<hr>";
	    foreach($todayhaoma as $numbers){
	    ?>
		    <img width="100" src="./images/<?=$file[$numbers] ?>">
		    <?php   
	    }
		}else{
			echo $row['pkp'];
		    echo "<hr>";
		    $todayhaoma = explode('-', $row['pkp']);
		    array_splice($todayhaoma,0,1); 
		    foreach($todayhaoma as $numbers){
		    ?>
		    <img width="100" src="./images/<?=$file[$numbers] ?>">
		    <?php   
		    }
		}
		




	// 现在运行完成，在此关闭连接
    $conn = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}




    ?>
