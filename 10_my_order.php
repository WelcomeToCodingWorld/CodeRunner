<?php
/***
*接收客户端提交的uid，返回该用户的所有订单信息，
*包括订单的基本信息，以及订单中的商品，形如：
 [
 	{oid: 900008, rcvName: '', price: 0, products: [ {},{},{} ]},
 	{oid: 900009, rcvName: '', price: 0, products: [ {},{} ]}
 ]
*/
header('Content-Type: application/json');

@$uid = $_REQUEST['uid'] or die('{"code":-2,"msg":"用户编号不能为空"}');

require('init_jd.php');

//SQL1:根据uid查询其所有的订单
$sql = "SELECT * FROM jd_order WHERE userId=$uid";
$result = mysqli_query($conn,$sql);
$orderList = mysqli_fetch_all($result, MYSQLI_ASSOC);

//遍历每个订单，查询该订单中的产品信息
foreach($orderList as $i=>$order){
  $oid = $order['oid'];  //每个订单的编号
  //根据订单编号，查询出该订单中的产品编号（可能有多个）
  //再查询产品信息，要求编号在上述范围内
  $sql = "SELECT * FROM jd_product WHERE pid IN (SELECT productId FROM jd_order_detail WHERE orderId=$oid)";
  $result = mysqli_query($conn,$sql);
  $plist = mysqli_fetch_all($result, MYSQLI_ASSOC);

  //$order['products'] = $plist; //无效！！！
  $orderList[$i]['products'] = $plist;
}
echo json_encode($orderList);


