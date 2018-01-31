<?php 
//禁用错误报告
error_reporting(0);
require_once('conn.php');
$id = $_GET["id"];
$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //连接数据库
mysql_query("set names 'utf8'"); //数据库输出编码 
mysql_select_db($mysql_database); //打开数据库
$sql ="select * from data where id =$id"; //SQL语句
$result = mysql_query($sql,$conn); //查询
$row = mysql_fetch_array($result);
echo "<h1>".substr($row['creatime'],0,10)."</h1>";
echo $row['pkp'];
echo "<hr>";
$haoma = explode('-',$row['pkp']);
$dir="./images/";
$file=scandir($dir);
array_splice($file,0,2); 
array_splice($haoma,0,1); 
foreach($haoma as $numbers){
?>
<img width="100" src="./images/<?=$file[$numbers] ?>">
<?php	
}