
<?php 
// error_reporting(0);//禁用错误报告

header("Content-type:text/html;charset=utf-8");

//引入数据库配置文件
require_once('conn.php');

$tiaojian = _post('tiaojian');

//查询列表的数据
@$allNum = allNews();
@$pageSize = 7; //约定没页显示几条信息
@$pageNum = empty($_GET["pageNum"])?1:$_GET["pageNum"];
@$endPage = ceil($allNum/$pageSize); //总页数
@$array = news($pageNum,$pageSize,$tiaojian);

?>
<a href="index1.php">生成今日数据</a>
<hr>
<a href="javascript:void(0)" onclick="disp_confirm()">清空所有数据</a>
<hr>

<form name="form1" method="post" action="index.php">
<input type="text" placeholder="例xx-xx" name="tiaojian" size="10"><input type="submit" name="搜索" value="搜索">
</form>

<hr>


<table border="1" style="text-align: center" cellpadding="0">

    <tr>
        <td>编号</td>
        <td>时间</td>
        <td>星期</td>
    </tr>
    <?php
    $bh = 1;
    if(empty($array)){echo "<tr><td colspan='4'>该日期的数据不存在！！！</td></tr>";};

	    foreach($array as $key=>$values){
	        echo "<tr>";
	        echo "<td>{$bh}</td>";
	        $todaytime=date("Y-m-d",strtotime($values->creatime));

	    ?>  
	         <td><a href="show.php?id=<?=$values->Id ?>"><?=$todaytime?></a></td>
	         <td><?php echo get_week($todaytime); ?></td>
	    <?php
	        echo "</tr>";
	        $bh++;
	    }
    ?>
</table>
<?php if($endPage>1){ ?>
	<div>
	    <a href="?pageNum=1">首页</a>
	    <a href="?pageNum=<?php echo $pageNum==1?1:($pageNum-1)?>">上一页</a>
	    <a href="?pageNum=<?php echo $pageNum==$endPage?$endPage:($pageNum+1)?>">下一页</a>
	    <a href="?pageNum=<?php echo $endPage?>">尾页</a>
	</div>
<?php } ?>



<?php 

//解决POST数据未定义报提示的问题
function _post($str){ 
$val = !empty($_POST[$str]) ? $_POST[$str] : null; 
return $val; 
} 


//换行输出数组内容
function print_r_br($array){
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

//分页的函数
function news($pageNum = 1, $pageSize = 7,$tiaojian)
{
	// 定义全局变量引用conn.php中的内容
	global $mysql_server_name,$mysql_username,$mysql_password,$mysql_database;

    $array = array();
    $coon = mysqli_connect($mysql_server_name, $mysql_username, $mysql_password);
    mysqli_select_db($coon, $mysql_database);
    mysqli_set_charset($coon, "utf8");
    // limit为约束显示多少条信息，后面有两个参数，第一个为从第几个开始，第二个为长度
    $rs = "select * from data where creatime like '%$tiaojian%' order by creatime desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $r = mysqli_query($coon, $rs);
    while ($obj = mysqli_fetch_object($r)) {
        $array[] = $obj;
    }
    mysqli_close($coon,$mysql_database);
    return $array;
}

//显示总页数的函数
function allNews()
{	
	// 定义全局变量引用conn.php中的内容
	global $mysql_server_name,$mysql_username,$mysql_password,$mysql_database;

    $coon = mysqli_connect($mysql_server_name, $mysql_username, $mysql_password);
    mysqli_select_db($coon, $mysql_database);
    mysqli_set_charset($coon, "utf8");
    $rs = "select count(*) num from data"; //可以显示出总页数
    $r = mysqli_query($coon, $rs);
    $obj = mysqli_fetch_object($r);
    mysqli_close($coon,$mysql_database);
    return $obj->num;
}

//计算星期
function get_week($date){
    //强制转换日期格式
    $date_str=date('Y-m-d',strtotime($date));
    //封装成数组
    $arr=explode("-", $date_str);
    //参数赋值
    //年
    $year=$arr[0];
    //月，输出2位整型，不够2位右对齐
    $month=sprintf('%02d',$arr[1]);
    //日，输出2位整型，不够2位右对齐
    $day=sprintf('%02d',$arr[2]);
    //时分秒默认赋值为0；
    $hour = $minute = $second = 0;
    //转换成时间戳
    $strap = mktime($hour,$minute,$second,$month,$day,$year);
    //获取数字型星期几
    $number_wk=date("w",$strap);
    //自定义星期数组
    $weekArr=array("日","一","二","三","四","五","六");
    //获取数字对应的星期
    return $weekArr[$number_wk];
  }

 ?>



<!-- 删除提示框 -->

 <script type="text/javascript">

function disp_confirm()
{
	var r=confirm("确认后将会清空所有数据！")
	var Nurl=window.location.href;
	// alert(Nurl);
	
	if (r==true)
	{
		window.location.href= Nurl + "deldb.php"; 
	}
	else
	{
		return false;
	}
}
</script>