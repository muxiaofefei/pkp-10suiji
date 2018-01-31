<?php 
function print_r_br($array){
//换行输出数组内容
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

$dir="./images/";//图片存放路径
$file=scandir($dir);//读取图片文件夹下的图片名称
array_splice($file,0,2); //删除./和../

print_r_br($file);