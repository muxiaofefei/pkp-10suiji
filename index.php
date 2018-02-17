<?php 
//禁用错误报告
error_reporting(0);
require_once('conn.php');
function print_r_br($array){
//换行输出数组内容
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

header("Content-type:text/html;charset=utf-8");

date_default_timezone_set("Asia/Shanghai");//设置时间为中国时间
$today = date("Y-m-d");//获取今天的日期

$tiaojian = $_POST['tiaojian'];

$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password); //连接数据库
mysql_query("set names 'utf8'"); //数据库输出编码
mysql_select_db($mysql_database); //打开数据库
$numbers = range (0,53); // — 建立一个包含0-53的数组 
shuffle ($numbers); //shuffle 将数组顺序随即打乱 
$num=10; //设置截取的个数
$result = array_slice($numbers,0,$num); //array_slice 取该数组中的某一段 
$dir="./images/";//图片存放路径
$file=scandir($dir);//读取图片文件夹下的图片名称
array_splice($file,0,2); //删除./和../两个目录
foreach($result as $numbers){
    $haoma = $haoma.'-'.$numbers;//将10个随机数用-进行拼接
}
$sql1 ="select * from data where creatime like '$today%'"; //SQL语句
$result = mysql_query($sql1,$conn); //查询
$row = mysql_fetch_array($result);
//如果数据库中没有今天日期则写入数据
$riqi = date("Y-m-d H:i:s",time());
if($row['creatime'] == ""){
    $sql = "insert into data (pkp,creatime) values ('$haoma','$riqi')";
    mysql_query($sql);
    mysql_close(); //关闭MySQL连接
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
//分页的函数
function news($pageNum = 1, $pageSize = 7,$tiaojian)
{
    $array = array();
    $coon = mysqli_connect("127.0.0.1", "root", "root");
    mysqli_select_db($coon, "pkp");
    mysqli_set_charset($coon, "utf8");
    // limit为约束显示多少条信息，后面有两个参数，第一个为从第几个开始，第二个为长度
    $rs = "select * from data where creatime like '%$tiaojian%' order by creatime desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $r = mysqli_query($coon, $rs);
    while ($obj = mysqli_fetch_object($r)) {
        $array[] = $obj;
    }
    mysqli_close($coon,"pkp");
    return $array;
}
//显示总页数的函数
function allNews()
{
    $coon = mysqli_connect("127.0.0.1", "root", "root");
    mysqli_select_db($coon, "pkp");
    mysqli_set_charset($coon, "utf8");
    $rs = "select count(*) num from data"; //可以显示出总页数
    $r = mysqli_query($coon, $rs);
    $obj = mysqli_fetch_object($r);
    mysqli_close($coon,"pkp");
    return $obj->num;
}
    @$allNum = allNews();
    @$pageSize = 7; //约定没页显示几条信息
    @$pageNum = empty($_GET["pageNum"])?1:$_GET["pageNum"];
    @$endPage = ceil($allNum/$pageSize); //总页数
    @$array = news($pageNum,$pageSize,$tiaojian);
    ?>
<table border="1" style="text-align: center" cellpadding="0">
     <form name="form1" method="post" action="index.php">
    <tr>
        <td>编号</td>
        <td>发布日期</td>
        <td valign="middle">
           
            <input type="text" name="tiaojian" size="10"><input type="submit" name="搜索" value="搜索">
            
        </td>
        </form>
    </tr>
    <?php
    $bh = 1;
    foreach($array as $key=>$values){
        echo "<tr>";
        echo "<td>{$bh}</td>";
        $todaytime=strtotime($values->creatime);
    ?>  
         <td><a href="show.php?id=<?=$values->Id ?>"><?=date("Y-m-d",$todaytime)?></a></td>
    <?php
        echo "</tr>";
        $bh++;
    }
    ?>
</table>
<div>
    <a href="?pageNum=1">首页</a>
    <a href="?pageNum=<?php echo $pageNum==1?1:($pageNum-1)?>">上一页</a>
    <a href="?pageNum=<?php echo $pageNum==$endPage?$endPage:($pageNum+1)?>">下一页</a>
    <a href="?pageNum=<?php echo $endPage?>">尾页</a>
</div>
