<?php
header('Content-Type:application/json'); // 返回头类型定义
date_default_timezone_set('Asia/Shanghai'); // php时区修正
$time = date("Y/m/d G:i:s");
$servername = "localhost"; // 服务器地址
$username = "YourUsernameHere"; // 用户名
$password = "YourPassWordHere"; // 密码
$dbName = "YourDBNameHere"; // 数据库名
$conn = mysqli_connect($servername,$username,$password,$dbName); // 数据库连接
if (!$conn) {
    die("连接失败！".mysqli_connect_error());
}
$type = $_GET['type'];
$sql = $_GET['sql']; // url get查询参数提取
switch ($type) {
    case 1: {
        $counter = 1;
        $return = array();
        $returnField = array();
        if ($sql==='') {
            $return['status'] = array("code"=>"1001","success"=>false,"message"=>"请输入查询语句！");
        } else {
            $result = mysqli_query($conn,$sql);
            if ($result) {
                $return['status'] = array("code"=>"1000","success"=>true,"message"=>"成功","query_time"=>$time,"sql_performed"=>$sql);
                $lines = mysqli_num_rows($result);
                $return['field'] = array();
                $return['content'] = array();
                if ($lines>0) {
                    while ($field = mysqli_fetch_field($result)) {
                        array_push($returnField,$field->name);
                    }
                    $return['field'] = $returnField;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $row['index']=$counter;
                        array_push($return['content'],$row);
                        $counter++;
                    }
                }
            } else {
                $return['status'] = array("code"=>"1002","success"=>false,"message"=>mysqli_error($conn));
            }
        }
        break;
    }
    case 2: {
        if ($sql==='') {
            $return['status'] = array("code"=>"1001","success"=>false,"message"=>"请输入SQL语句！");
        } else {
            $result = mysqli_query($conn,$sql);
            if ($result) {
                $return['status'] = array("code"=>"1000","success"=>true,"message"=>"执行成功！","sql_performed"=>$sql);
            } else {
                $return['status'] = array("code"=>"1002","success"=>false,"message"=>mysqli_error($conn));
            }
        }
    }
}
echo json_encode($return);
mysqli_close($conn);
